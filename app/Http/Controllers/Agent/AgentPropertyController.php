<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\City;
use App\Models\Plan;
use App\Models\Facility;
use App\Models\ImagePreset;
use App\Models\MultiImage;
use App\Models\PackagePlan;
use App\Models\PlanFeatures;
use App\Models\PropertyMessage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Propertysize;
use App\Models\State;
use App\Models\User;
use App\Models\Schedule;
use App\Mail\ScheduleMail;
use App\Models\Neighborhoodcity;
use App\Traits\ImageGenTrait;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use DataTables;

class AgentPropertyController extends Controller
{
    public $path = "upload/property/thumbnail/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    public function __construct()
    {
        $this->image_preset = ImagePreset::whereIn('id', [1, 4, 8])->get();
        $this->image_preset_main = ImagePreset::find(6);
    }
    //
    public function AgentProperty()
    {
        $properties = Property::where('agent_id', Auth::user()->id)->get();

        return view('agent.property.all_property', compact('properties'));
    }
    public function create()
    {
        if (Auth::user()->role == 'agent') {
            $type = PropertyType::pluck('type_name', 'id')->toArray();
            $state = State::pluck('name', 'id')->toArray();
            $agent = User::where('role', 'agent')->pluck('name', 'id')->toArray();
            $amenities = Amenities::pluck('amenities_name')->toArray();
            $plans = PackagePlan::where('user_id', Auth::user()->id)->get();
            $property = Property::where('agent_id', Auth::user()->id)->get();
            $propertysizes = Propertysize::pluck('name', 'id')->toArray();
            //dd( (int)Auth::user()->credit);
            if ((int)Auth::user()->credit <= $property->count()) {
                $notification = array(
                    'message' => 'You can add only ' . (Auth::user()->credit) . ' Property',
                    'alert-type' => 'warning',
                );
                return redirect()->route('agent.buy.package')->with($notification);
            } else {
                return view('agent.property.add_property', compact('type', 'state', 'agent', 'amenities', 'propertysizes'));
            }
        }
        return view('/');
    }

    public function store(Request $request)
    {
        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);
        $image = $request->file('property_thumbnail');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        $property_id = Property::insertGetId([

            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_size_type' => $request->propertysizes,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city_id' => $request->city,
            'state_id' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => 0,
            'hot' => 0,
            'agent_id' => Auth::user()->id,
            'status' => 1,
            'property_thumbnail' => $save_url,
        ]);
        $images = $request->file('multi_img');
        foreach ($images as $image) {

            $image_preset = ImagePreset::whereIn('id', [1])->get();
            $image_preset_main = ImagePreset::find(7);
            $path = "upload/property/multi-image/";
            $upload_img = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);

            $multi = MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $upload_img,
            ]);
        } // End Foreach
        // Facility Added Here //
        $i = 1;
        $facilities = count($request->facility_name);
        while ($i != $facilities) {
            $multi = Facility::insert([
                'property_id' => $property_id,
                'facility_name' => $request->facility_name[$i],
                'distance' => $request->distance[$i],
            ]);
            $i++;
        } // End White

        User::findOrFail(Auth::user()->id)->update([
            'credit' => Auth::user()->credit + 1,
        ]);
        $notification = array(
            'message' => 'Agent Property Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('agent.properties')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $type = PropertyType::pluck('type_name', 'id')->toArray();
        $state = State::pluck('name', 'id')->toArray();
        $agent = ($property->agent_id != null) ? (User::find($property->agent_id)->name) : '-';
        $amenities = Amenities::pluck('amenities_name')->toArray();
        if ($property->city_id != NULL) {
            $cityinfo = City::find($property->city_id)->name;
        } else {
            $cityinfo = '-';
        }

        $amenities = Amenities::pluck('amenities_name')->toArray();
        $multiImage = MultiImage::where('property_id', $property->id)->get();
        $facilities = Facility::where('property_id', $property->id)->get();
        $propertysizes = Propertysize::pluck('name', 'id')->toArray();
        return view('agent.property.show_property', compact('property', 'cityinfo', 'type', 'state', 'agent', 'amenities', 'propertysizes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $type = PropertyType::pluck('type_name', 'id')->toArray();
        $state = State::pluck('name', 'id')->toArray();
        $agent = User::where('role', 'agent')->pluck('name', 'id')->toArray();
        $amenities = Amenities::pluck('amenities_name')->toArray();
        $cities = City::pluck('name', 'id')->toArray();
        $multiImage = MultiImage::where('property_id', $property->id)->get();
        $facilities = Facility::where('property_id', $property->id)->get();
        $propertysizes = Propertysize::pluck('name', 'id')->toArray();
        $neighborhood = Neighborhoodcity::pluck('name', 'id')->toArray();
        return view('agent.property.edit_property', compact('property', 'cities', 'type', 'state', 'agent', 'amenities', 'multiImage', 'facilities', 'propertysizes', 'neighborhood'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
        $property->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_size_type' => $request->propertysizes,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city_id' => $request->city,
            'state_id' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

        ]);

        $notification = array(
            'message' => 'Agent Property Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function update_img(Request $request, Property $property)
    {
        $image = $request->file('property_thumbnail');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        $this->imageRemove($image, $this->image_preset);
        $property->update([
            'property_thumbnail' => $save_url,
        ]);
        $notification = array(
            'message' => 'Agent Property Image Thumbnail Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $img = explode('.', $property->property_thumbnail);
        $small_img = $img[0] . "_small." . $img[1];
        if (file_exists($property->property_thumbnail)) {
            unlink($property->property_thumbnail);
        }
        if (file_exists($small_img)) {
            unlink($small_img);
        }
        $multi = MultiImage::where('property_id', $property->id)->get();
        foreach ($multi as $mu) {
            if (file_exists($mu->photo_name)) {
                unlink($mu->photo_name);
            }
            $mu->delete();
        }
        $property->delete();
        if (Auth::user()->credit > 0) {
            User::findOrFail(Auth::user()->id)->update([
                'credit' => Auth::user()->credit - 1,
            ]);
        }
        $notification = array(
            'message' => 'Agent Property Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function multiImageDestory($id)
    {
        $multi = MultiImage::findOrFail($id);
        if (file_exists($multi->photo_name)) {
            unlink($multi->photo_name);
        }
        $img = explode('.', $multi->photo_name);
        $small_img = $img[0] . "_small." . $img[1];
        if (file_exists($small_img)) {
            unlink($small_img);
        }
        $multi->delete();
        $notification = array(
            'message' => 'Image Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Upload More Multiple Images.
     */
    public function multiImageUpdate(Request $request, Property $property)
    {

        $images = $request->file('multi_img');
        foreach ($images as $image) {
            $image_preset = ImagePreset::whereIn('id', [1])->get();
            $image_preset_main = ImagePreset::find(7);
            $path = "upload/property/multi-image/";
            $upload_img = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
            $this->imageRemove($image, $image_preset);
            $multi = MultiImage::insert([
                'property_id' => $property->id,
                'photo_name' => $upload_img,
            ]);
        } // End Foreach
        $notification = array(
            'message' => 'Multiple Images Updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Update Single Multiple Image.
     */
    public function multiImageUpdateOne(Request $request, $id)
    {
        $multis = MultiImage::where('id', $id)->first();
        $image = $request->file('multi_img');
        $image_preset = ImagePreset::whereIn('id', [1])->get();
        $image_preset_main = ImagePreset::find(7);
        $path = "upload/property/multi-image/";
        $upload_img = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        $this->imageRemove($multis->photo_name, $image_preset);
        $multi = MultiImage::where('id', $id);
        $multi->update([
            'photo_name' => $upload_img,
        ]);

        $notification = array(
            'message' => 'Multiple Single Images Updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Show all the states.
     */
    public function states(Property $property)
    {
        $city = '';
        $id = $_POST['state_id'];
        $cities = City::where('state_id', $id)->get();

        echo '<option selected="selected">---Select City---</option>';
        foreach ($cities as $coss) {
            $city .= '<option value="' . $coss->id . '">' . $coss->id . '. ' . ucfirst($coss->name) . '</option>';
        }
        return ($city);
    }
    public function BuyPlantype()
    {
        $city = '';
        $id = $_POST['id'];
        $plan = Plan::select('plan_discount', 'plan_amount')->where('id', $id)->get();
       
        return ($plan);
    }

    public function facilityUpdate(Request $request, Property $property)
    {
        $i = 0;
        $facilities = count($request->facility_name);

        $facility_list = ['Hospital', 'SuperMarket', 'School', 'Entertainment', 'Pharmacy', 'Airport', 'Railways', 'Bus Stop', 'Beach', 'Mall', 'Bank'];
        if ($request->facility_name == null) {
            return redirect()->back();
        } else {
            Facility::where('property_id', $property->id)->delete();

            while ($i != $facilities) {
                $multi = Facility::insert([
                    'property_id' => $property->id,
                    'facility_name' => $facility_list[$request->facility_name[$i]],
                    'distance' => $request->distance[$i],
                ]);
                $i++;
            } // End White
        }
        $notification = array(
            'message' => 'Facilities Updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function facilityDestory($id)
    {

        $fact = Facility::find($id);
        Facility::where("id", $id)->delete();
        $notification = array(
            'message' => 'Facility Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('properties.edit', $fact->property_id)->with($notification);
    }
    public function BuyPackage()
    {
        $plans = Plan::where('status',0)->skip(1)->take(50)->get();
        return view('agent.package.buy_package', compact('plans'));
    }
    public function BuyPlan(Request $request)
    {
       
        $id= $request->id;
        $plan_type = $request->plan_type;
       
        $user = User::find(Auth::user()->id);        
        $plan = Plan::findOrFail($id);
        return view('agent.package.buy_plan', compact('user', 'plan','plan_type'));
    }
    public function BuyPlanStore(Request $request)
    {
       
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
       
       // dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $orderinfo=explode("-", $response['purchase_units'][0]['reference_id']);
            $payment = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $current_plan =  Plan::findOrFail($orderinfo[0]);
            $id = Auth::user()->id;
            $uid = User::findOrFail($id);
            $nid = $uid->credit;
            PackagePlan::insert([
                'user_id' => $id,
                'package_name' => $current_plan->plan_name,
                'package_credits' => $current_plan->plan_credit,
                'invoice' => 'ERS' . mt_rand(10000000, 99999999),
                'package_amount' => $payment,
                'package_discount' => $orderinfo[2],
                'order_info' => $response['purchase_units'][0]['reference_id'],
                'order_id' => $response['id'],
                'order_by' => 'online',
                'created_at' => Carbon::now(),
            ]);
            User::where('id', $id)->update([
                'credit' =>  $current_plan->plan_credit + $nid,
            ]);
            $notification = array(
                'message' => 'Transaction complete.',
                'alert-type' => 'success'
            );
            return redirect()
                ->route('agent.buy.package.package_history')
                ->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'warning'
            );
            return redirect()
                ->route('agent.buy.package')
                ->with($notification);
        }
        

               }

    public function PackageHistory()
    {
        $id = Auth::user()->id;
        $packagehistory = PackagePlan::where('user_id', $id)->get();
        return view('agent.package.package_history', compact('packagehistory'));
    } // End Method 
    public function PackageInvoice($id)
    {
        $packagehistory = PackagePlan::where('id', $id)->first();
        $pdf = Pdf::loadView('agent.package.packae_history_invoice', compact('packagehistory'))->setPaper('a4')->setOption(['tempDir' => public_path(), 'chroot' => public_path()]);
        return $pdf->download('invoice.pdf');
    }

    public function AgentPropertyMessage()
    {

        $id = Auth::user()->id;
        $usermsg = PropertyMessage::where('agent_id', $id)->get();
        return view('agent.message.all_message', compact('usermsg'));
    } // End Method 
    public function AgentMessageDetails($id)
    {

        $uid = Auth::user()->id;
        $usermsg = PropertyMessage::where('agent_id', $uid)->get();

        $msgdetails = PropertyMessage::findOrFail($id);
        return view('agent.message.message_details', compact('usermsg', 'msgdetails'));
    } // End Method  
    public function AgentScheduleRequest()
    {

        $id = Auth::user()->id;
        $usermsg = Schedule::where('agent_id', $id)->get();
        return view('agent.schedule.schedule_request', compact('usermsg'));
    } // End Method
    public function AgentDetailsSchedule($id)
    {

        $schedule = Schedule::findOrFail($id);
        return view('agent.schedule.schedule_details', compact('schedule'));
    } // End Method  
    public function AgentUpdateSchedule(Request $request)
    {

        $sid = $request->id;

        Schedule::findOrFail($sid)->update([
            'status' => '1',

        ]);
        //// Start Send Email 

        $sendmail = Schedule::findOrFail($sid);

        $data = [
            'tour_date' => $sendmail->tour_date,
            'tour_time' => $sendmail->tour_time,
            'message' => $sendmail->message
        ];

        Mail::to($request->email)->send(new ScheduleMail($data));
        $notification = array(
            'message' => 'You have Confirm Schedule Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.schedule.request')->with($notification);
    } // End Method 

    public function AgentDeleteSchedule($id)
    {
        $data = Schedule::findOrFail($id);

        $data->delete();
        $notification = array(
            'message' => 'Property Tour Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function neighborhoodcity()
    {
        $city = '';
        $id = $_POST['city_id'];
        $cities = Neighborhoodcity::where('city_id', $id)->get();

        echo '<option selected="selected">---Select Neighborhood City---</option>';
        foreach ($cities as $coss) {
            $city .= '<option value="' . $coss->id . '">' . $coss->id . '. ' . ucfirst($coss->name) . '</option>';
        }
        return ($city);
    }
    public function StatusUpdate(Request $request, Property $property)
    {
        $property = Property::findOrFail($request->property_id);
        $property->update([
            'status' => ($property->status == 1) ? 0 : 1,
        ]);

        return response()->json(['success' => 'Status changed Successfully']);
    }
    public function Ajax_Load(Request $request, Property $property)
    {

        
        $query = Property::select('id', 'ptype_id', 'property_name', 'property_slug', 'property_code', 'property_status', 'property_thumbnail', 'city_id', 'agent_id', 'status', 'created_at', 'updated_at')->where('agent_id', Auth::user()->id)->get();

        return DataTables::of($query)
            ->addColumn('image', function (Property $property) {
                $img = explode('.', $property->property_thumbnail);
                $table_img = $img[0] . '_small.' . $img[1];
                return  '<img src="' . asset($table_img) . '">';
            })            
            ->addColumn('info', function (Property $property) {
                $pname = ucfirst($property->property_name);
                $code  = $property->property_code;
                $type = $property->type->type_name;
                $pstatus = ucfirst($property->property_status);
                $city = $property->city?->name;
                $created_at = $property->created_at->format('d-m-Y g:i A ');
                $updated_at = $property->updated_at->format('d-m-Y g:i A ');
                return  '<strong class="text-primary">Name:</strong>' . $pname . '<br>
                    <strong class="text-info">Code:</strong>' . $code . '<br>
                    <strong class="text-warning">Type:</strong>:' . $type . '<br>
                    <strong class="text-danger">Status Type:</strong>' . $pstatus . '<br>
                    <strong class="text-primary">City:</strong>' . $city . '<br>
                    <strong class="text-secondary">Created:</strong>' . $created_at . '<br>
                    <strong class="text-secondary">Updated:</strong>' . $updated_at . '';
            })
            ->addColumn('status', function (Property $property) {
                $btn = $property->status == 0 ? 'danger' : 'success';
                $status = $property->status == 0 ? 'Deactive' : 'Active';
                return  '<a href="#" id="currentStatus' . $property->id . '"><span
                                                        class="badge rounded-pill bg-' . $btn . '">' . $status . '</span></a>';
            })
            ->addColumn('change', function (Property $property) {
                $checked = $property->status == 1 ? 'checked' : '';
                return  '<input data-id="' . $property->id . '" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="Deactive"
                                                    ' . $checked . '>';
            })
            ->addColumn('action', function (Property $property) {
                $url = url('property/details/' . $property->id . '/' . $property->property_slug);
                $show = route('properties.show', $property->id);
                $x =     \Collective\Html\FormFacade::open([
                    'method' => 'delete',
                    'route' => ['agent.properties.destroy', $property->id],
                    'class' => 'forms-sample',
                ]);
                $x .= '<a href="' . $url . '" class="btn btn-inverse-info me-2" title="Public View"  target="_blank"> <i
                                                            data-feather="eye"></i> </a>';

                $x .= '<a href="' .  $show . '"
                                                        class="btn btn-inverse-info me-2" title="List View"> <i
                                                            data-feather="monitor"></i> </a>';
                $x .= '<a href="' . route('agent.properties.edit', $property->id) . '" class="btn btn-inverse-warning me-2"><i data-feather="edit"></i></a>';
                $x .= '<button type="submit" class="btn btn-inverse-danger btn-submit"><i
                                                            data-feather="trash-2"></i></button>';
                $x .=  \Collective\Html\FormFacade::close();
                return $x;
            })

            ->rawColumns(['image', 'uploadby', 'info', 'status', 'change', 'action'])
            ->make(true);
    }
}
