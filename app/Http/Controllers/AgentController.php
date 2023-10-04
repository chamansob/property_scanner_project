<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PackagePlan;
use App\Models\Plan;
use App\Models\ImagePreset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Traits\ImageGenTrait;
use Illuminate\Validation\Rules;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    //Agent Dashboard
    public $path = "upload/agent_images/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    public function __construct()
    {
        $this->image_preset = ImagePreset::whereIn('id', [2,4,9])->get();
        $this->image_preset_main = ImagePreset::find(3);
    }
    public function AgentDashboard()
    {
        return view('agent.index');
    }
    public function AgentLogin()
    {
        return view('agent.agent_login');
    }
    public function AgentRegisterview()
    {
        return view('agent.agent_register');
    }
    public function AgentRegister(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'numeric', 'min:10'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => '0'
        ]);
        
        event(new Registered($user));

        Auth::login($user); 
        $current_plan=  Plan::findOrFail(1);        
        PackagePlan::insert([
        'user_id' => $user->id,
        'package_name' => $current_plan->plan_name,
        'package_credits' => $current_plan->plan_credit,
        'invoice' => 'ERS'.mt_rand(10000000,99999999),
        'package_amount' => $current_plan->plan_amount,
        'package_discount' => $current_plan->discount,
        'order_info' => $current_plan->id."-". $current_plan->plan_type."-" .$current_plan->plan_discount,
        'order_id'=>'',
        'order_by' => 'online',
        'created_at' => Carbon::now(), 
      ]);
       User::where('id',$user->id)->update([
            'credit' =>  $current_plan->plan_credit,
        ]);
        $validity= $current_plan->plan_type ==0  ? 30 : 365;
        User::where('id', $user->id)->update([
            'validity' =>  $validity,
        ]);
        return redirect(RouteServiceProvider::AGENT);
    }
    public function AgentLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' =>  'Agent Logout Successfully',
            'alert-type' => 'success'
        );
       
        return redirect('/agent/login')->with($notification);
    }
    public function AgentProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('agent.agent_profile_view', compact('profileData'));
    }

    public function AgentProfileStore(Request  $request)
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
            'message' =>  'Agent Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function AgentChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('agent.agent_change_password', compact('profileData'));
    }
    public function AgentPasswordUpdate(Request $request)
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
                'message' =>  'Agent Password Updated Successfully',
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
}
