<?php

namespace App\Http\Controllers;

use App\Models\ImagePreset;
use App\Models\PackagePlan;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ImageGenTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    //Admin Dashboard
    public $path = "upload/admin_images/";
    public $path_agent = "upload/agent_images/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    public function __construct()
    {
        $this->image_preset = ImagePreset::whereIn('id', [2, 4, 9])->get();
        $this->image_preset_main = ImagePreset::find(3);
    }
    public function AdminDashboard()
    {
        return view('admin.index');
    }
    public function AdminLogin()
    {
        return view('admin.admin_login');
    }
    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' =>  'Admin Logout Successfully',
            'alert-type' => 'success'
        );       
        return redirect('/admin/login')->with($notification);
    }
    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    }

    public function AdminProfileStore(Request  $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->about = $request->about;

        if ($image = $request->file('photo')) {
            $this->imageRemove(Auth::user()->photo, $this->image_preset);
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
            $data->photo = $save_url;
        }

        $data->save();
        $notification = array(
            'message' =>  'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }
    public function AdminPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $id = Auth::user()->id;
            $data = User::find($id);
            $data->password = Hash::make($request->new_password);
            $pp = $data->save();
            $notification = array(
                'message' =>  'Admin Password Updated Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' =>  'Old Password does not Matched',
                'alert-type' => 'error'
            );
        }
        return back()->with($notification);
    }

    /////// Agent User All Methods ///////

    public function AllAgents()
    {
        $agents = User::where('role', 'agent')->get();
        return view('backend.agents.all_agent', compact('agents'));
    }

    public function AgentStatusUpdate(Request $request)
    {

        $agent = User::find($request->user_id);
        $id = $agent->update([
            'status' => ($request->status == 1) ? 0 : 1,
        ]);

        return response()->json(['success' => 'Status changed Successfully']);
    }
    public function AgentEmailVerification(Request $request,$id)
    {

        $agent = User::find($id);
        $id = $agent->update([
            'email_verified_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' =>  'Email Verified Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);;
    }
    public function AgentDelete($id)
    {
        $agent = User::find($id);
        $agent->delete();
        $notification = array(
            'message' => 'Agent Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.agents')->with($notification);
    }
    public function AgentAdd()
    {
        return view('backend.agents.add_agent');
    }
    public function AgentStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'about' => $request->about,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => '1'
        ]);
        Auth::login($user);
        $current_plan =  Plan::findOrFail(1);
        $nid = $user->credit;
        PackagePlan::insert([
            'user_id' => $user->id,
            'package_name' => $current_plan->plan_name,
            'package_credits' => $current_plan->plan_credit,
            'invoice' => 'ERS' . mt_rand(10000000, 99999999),
            'package_amount' => $current_plan->plan_amount,
            'created_at' => Carbon::now(),
        ]);
        User::where('id', $user->id)->update([
            'credit' =>  $current_plan->plan_credit + $nid,
        ]);
        event(new Registered($user));

        $notification = array(
            'message' => 'New Agent Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.agents')->with($notification);
    }
    public function AgentEdit($id)
    {
        $agent = User::find($id);
        return view('backend.agents.edit_agent', compact('agent'));
    }
    public function AgentUpdate(Request $request)
    {
        $agent = User::find($request->agent_id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($image = $request->file('photo')) {
            // dd($request->file('photo'));
            $this->imageRemove($agent->photo, $this->image_preset);
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path_agent);
        } else {
            $save_url = $agent->photo;
        }

        $agent->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'about' => $request->about,
            'password' => (empty($request->password)) ? $agent->password : Hash::make($request->password),
            'photo' => $save_url,
            'status' => $request->status,
        ]);


        $notification = array(
            'message' => 'Agent Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.agent_edit', $request->agent_id)->with($notification);
    }
    public function AdminPackageHistory()
    {

        $packagehistory = PackagePlan::latest()->get();
        return view('backend.package.package_history', compact('packagehistory'));
    } // End Method 
    public function AdminPackageInvoice($id)
    {

        $packagehistory = PackagePlan::where('id', $id)->first();
        $pdf = Pdf::loadView('backend.package.packae_history_invoice', compact('packagehistory'))->setPaper('a4')->setOption(['tempDir' => public_path(), 'chroot' => public_path()]);
        return $pdf->download('invoice.pdf');
    }
    public function AdminPackageAdd($id)
    {
     
        $plan = Plan::skip(1)->take(10)->pluck('plan_name','id');
        $oneplan = Plan::skip(1)->first();
        $packagehistory = PackagePlan::where('user_id', $id)->get();
        $agent = User::where('role','agent')->find($id);
      
        return view( 'backend.package.packageadd', compact('agent','plan', 'oneplan', 'packagehistory'));
    }
    public function AdminPackageStore(Request $request)
    {
         $currency= currency_exchange(EXCHNAGE);
        //dd($request);
        $current_plan= Plan::find($request->plan_id);
        $uid = User::findOrFail($request->user_id);
        $nid = $uid->credit;
        if ($request->plan_type == 2) {
            $amount = $current_plan->plan_amount;
            $total = round($amount * $currency, 2);
            $discount = 0;
            $yearly = $current_plan->plan_amount * $currency;
        } else {
            $yearly = round($current_plan->plan_amount * ($request->plan_type == 0 ? 1 : 12));
            $discount = round($current_plan->plan_amount * ($request->plan_type == 0 ? 1 : 12) / 100 * $current_plan->plan_discount);
            $amount = round(($current_plan->plan_amount * ($request->plan_type == 0 ? 1 : 12) - $discount) / 12);
            $total = round(($yearly - $discount) * $currency, 2);
        }
       
        $orderinfo=$request->plan_id . "-" . $request->plan_type . "-" . $discount;
        PackagePlan::insert([
            'user_id' => $request->user_id,
            'package_name' => $current_plan->plan_name,
            'package_credits' => $current_plan->plan_credit,
            'invoice' => 'ERS' . mt_rand(10000000, 99999999),
            'package_amount' => $total,
            'package_discount' => $discount,
            'order_info' => $orderinfo,
            'order_id' => '',
            'order_by' => 'admin',
            'created_at' => Carbon::now(),
        ]);
        User::where('id', $request->user_id)->update([
            'credit' =>  $current_plan->plan_credit + $nid,
        ]);
        $notification = array(
            'message' => ucfirst($current_plan->plan_name).' Package Plan Added Successfully.',
            'alert-type' => 'success'
        );
        return redirect()
            ->route('admin.agentplan.add',$request->user_id)
            ->with($notification);
    }
     public function AdminPlanCheckType(Request $request)
    {
        $oneplan = Plan::where("status", 0)->where("id", $request->plan_id)->first();

        if($oneplan->plan_type==1)
        {  
        $plan = '<option value="1">' . PLANTYPE[1] .  '</option>';
        $plan .= '<option value="0">' . PLANTYPE[0] .  '</option>';
        }else{
            $plan = '<option value="0">' . PLANTYPE[0] .  '</option>';
         
        }
        return $plan;
    }
    public function AdminPlanCheck(Request $request)
    {
        $currency = currency_exchange(EXCHNAGE);
        $oneplan = Plan::where("status",0)->where("id", $request->plan_id)->first();
       // dd($oneplan->plan_amount);
       if($request->plan_type==0 || $oneplan->plan_type==0)
       {
    $x= ' <strong class="text-primary">Amount:</strong> <span class="amount">'.MONEY .'
                                    '. $oneplan->plan_amount.'</span> |
                                <strong class="text-success">Amount in ('.EXCHNAGE. '):</strong> <span
                                    class="exchnage_amount">'. EXCHNAGE .' ' . $oneplan->plan_amount *  $currency . '</span> |
                                <strong class="text-danger">Discount(%):</strong> <span
                                    class="discount_persantage">0%</span> |
                                <strong class="text-danger">Play Type:</strong> <span
                                    class="plan_type">'. PLANTYPE[$request->plan_type].'</span>';
       }else
       {
            $yearly = round($oneplan->plan_amount * ($request->plan_type == 0 ? 1 : 12));
            $discount = round($oneplan->plan_amount * ($request->plan_type == 0 ? 1 : 12) / 100 * $oneplan->plan_discount);
            $amount = round(($oneplan->plan_amount * ($request->plan_type == 0 ? 1 : 12) - $discount) / 12);
            $total = round(($yearly - $discount) * $currency, 2);
            $x = ' <strong class="text-primary">Amount:</strong> <span class="amount">' . MONEY . '
                                    ' . ($oneplan->plan_amount *12). '</span> |
                                <strong class="text-success">Amount in (' . EXCHNAGE . '):</strong> <span
                                    class="exchnage_amount">' . EXCHNAGE . ' ' . ($oneplan->plan_amount * 12)*  $currency . '</span> |
                                <strong class="text-danger">Discount(%):</strong> <span
                                    class="discount_persantage">' . $oneplan->plan_discount . '% -('. EXCHNAGE .' '.$discount. ')</span> |
                                <strong class="text-danger">Play Type:</strong> <span
                                    class="plan_type">' . PLANTYPE[$request->plan_type] . '</span> |
                                    <strong class="text-danger">Payable Amount:</strong> <span
                                    class="discount">' . $total . '</span>';
  
       }                       
                                    return $x;
    }
    public function AllAdmin()
    {
        $alladmin = User::where('role', 'admin')->get();
        return view('backend.pages.admin.all_admin', compact('alladmin'));
    } // End Method 
    public function AddAdmin()
    {

        $roles = Role::all();
        return view('backend.pages.admin.add_admin', compact('roles'));
    } // End Method 


    public function StoreAdmin(Request $request)
    {

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->about = $request->about;
        $user->password =  Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 0;
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    } // End Method 
    public function EditAdmin($id)
    {

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.pages.admin.edit_admin', compact('user', 'roles'));
    } // End Method

    public function UpdateAdmin(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->about = $request->about;
        $user->role = 'admin';
        $user->status = 0;
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    } // End Method 

    public function DeleteAdmin($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'New Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 
    public function AdminPackageHistoryDelete($id)
    {
        $packagehistory = PackagePlan::where('id', $id)->first();
        if (!is_null($packagehistory)) {
            $packagehistory->delete();
        }

        $notification = array(
            'message' => 'Package Plan Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
