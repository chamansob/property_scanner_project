<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\City;
use App\Models\Facility;
use App\Models\ImagePreset;
use App\Models\MultiImage;
use App\Models\Neighborhoodcity;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyMessage;
use App\Models\Propertysize;
use App\Models\State;
use App\Models\User;
use App\Traits\ImageGenTrait;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use DataTables;

class PropertyController extends Controller
{
    public $path = "upload/property/thumbnail/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;    
    public function __construct(){
    $this->image_preset = ImagePreset::whereIn('id', [1,4,8])->get();
    $this->image_preset_main = ImagePreset::find(6);
  }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::latest()->get();
        return view('backend.property.all_property', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = PropertyType::pluck('type_name', 'id')->toArray();
        $state = State::pluck('name', 'id')->toArray();
        $propertysizes = Propertysize::pluck('name', 'id')->toArray();
        $agent = User::where('role', 'agent')->pluck('name', 'id')->toArray();
        $amenities = Amenities::pluck('amenities_name')->toArray();
        return view('backend.property.add_property', compact('type', 'state', 'agent', 'amenities', 'propertysizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'property_size_type'=> $request->propertysizes,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city_id' => $request->city,
            'state_id' => $request->states,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => (isset($request->featured) ? $request->featured : 0),
            'hot' => (isset($request->hot) ? $request->hot : 0),
            'agent_id' => $request->agent_id,
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

        $notification = array(
            'message' => 'PropertysizeCreated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('properties.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $type = PropertyType::pluck('type_name', 'id')->toArray();
        $state = State::pluck('name', 'id')->toArray();
        $agent = ($property->agent_id!= null) ? (User::find($property->agent_id)->name) : '-';
        $amenities = Amenities::pluck('amenities_name')->toArray();
        if ($property->city_id != NULL) {
            $cityinfo = City::find($property->city_id)->name;
        } else {
            $cityinfo = '-';
        }
       
        $multiImage = MultiImage::where('property_id', $property->id)->get();
        $facilities = Facility::where('property_id', $property->id)->get();
        $propertysizes = Propertysize::pluck('name', 'id')->toArray();
        return view('backend.property.show_property', compact('property', 'cityinfo', 'type', 'state', 'agent', 'amenities', 'propertysizes'));
  
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
        $propertysizes = Propertysize::pluck('name', 'id')->toArray();
        $multiImage = MultiImage::where('property_id', $property->id)->get();
        $facilities = Facility::where('property_id', $property->id)->get();
        $propertysizes = Propertysize::pluck('name', 'id')->toArray();
        $neighborhood = Neighborhoodcity::pluck('name', 'id')->toArray();
        return view('backend.property.edit_property', compact('property', 'cities', 'type', 'state', 'agent', 'amenities', 'multiImage', 'facilities', 'propertysizes', 'neighborhood'));
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
            'featured' => (isset($request->featured) ? $request->featured : 0),
            'hot' => (isset($request->hot) ? $request->hot : 0),
            'agent_id' => $request->agent_id,

        ]);

        $notification = array(
            'message' => 'Property Updated Successfully',
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
            'message' => 'Property Image Thumbnail Updated Successfully',
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
        $notification = array(
            'message' => 'Property Deleted successfully',
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

    public function facilityUpdate(Request $request, Property $property)
    {
       $i=0;
       $facilities = count($request->facility_name);
      
       $facility_list = ['Hospital', 'SuperMarket', 'School', 'Entertainment', 'Pharmacy', 'Airport', 'Railways', 'Bus Stop', 'Beach', 'Mall', 'Bank'];
        if ($request->facility_name == NULL) {
           return redirect()->back();
        }else{
            Facility::where('property_id',$property->id)->delete();
         
        while ($i != $facilities) {
            $multi = Facility::insert([ 
                'property_id' =>$property->id,             
                'facility_name' =>$facility_list[$request->facility_name[$i]],
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
     
       $fact= Facility::find($id);
        Facility::where("id",$id)->delete();
         $notification = array(
            'message' => 'Facility Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('properties.edit',$fact->property_id)->with($notification);
    }
    public function StatusUpdate(Request $request, Property $property)
    {
      $property=Property::findOrFail($request->property_id);
        $property->update([
            'status' => ($property->status == 1) ? 0 : 1,
        ]);
        
        return response()->json(['success'=>'Status changed Successfully']);
    }
    public function AdminPropertyMessage(){

        $usermsg = PropertyMessage::latest()->get();
        return view('backend.message.all_message',compact('usermsg'));

    }// End Method  
    public function AdminMessageDetails($id){
       
        $msgdetails = PropertyMessage::findOrFail($id);
        $usermsg = PropertyMessage::where('agent_id',$msgdetails->agent_id)->get();
        
        return view('backend.message.message_details',compact('usermsg','msgdetails'));

    } // End Method 

    public function Ajax_Load(Request $request, Property $property)
    {
       
            $query = Property::select('id', 'ptype_id', 'property_name', 'property_slug', 'property_code', 'property_status', 'property_thumbnail', 'city_id', 'agent_id', 'status', 'created_at', 'updated_at')->get();

            return DataTables::of($query)
                ->addColumn('image', function (Property $property) {
            $img = explode('.', $property->property_thumbnail);
            $table_img = $img[0] . '_small.' . $img[1];
                    return  '<img src="'. asset($table_img).'">';
                })
                ->addColumn('uploadby', function (Property $property) {
                    $uploaby= ($property->agent?->name) ? $property->agent->name : "Admin";
                    $btn=($property->agent?->name) ? 'inverse-primary' : 'inverse-warning' ;
                    $link=($property->agent?->name) ? route("agent.details",$property->agent->id) : '#' ;
                    return  '<a href="'. $link.' "  target="_blank" class="btn btn-sm btn-'.$btn.' "> '. $uploaby.'</a>';
                })
                ->addColumn('info', function (Property $property) {
                    $pname = ucfirst($property->property_name);
                    $code  = $property->property_code;
                    $type= $property->type->type_name;
                    $pstatus = ucfirst($property->property_status);
                    $city=$property->city?->name ;
                    $created_at= $property->created_at->format('d-m-Y g:i A ');
                    $updated_at= $property->updated_at->format('d-m-Y g:i A ');
                    return  '<strong class="text-primary">Name:</strong>'.$pname.'<br>
                    <strong class="text-info">Code:</strong>'. $code.'<br>
                    <strong class="text-warning">Type:</strong>:'. $type.'<br>
                    <strong class="text-danger">Status Type:</strong>'. $pstatus.'<br>
                    <strong class="text-primary">City:</strong>'.$city.'<br>
                    <strong class="text-secondary">Created:</strong>'.$created_at.'<br>
                    <strong class="text-secondary">Updated:</strong>'.$updated_at.'';
                })
        ->addColumn('status', function (Property $property) {
            $btn= $property->status == 0 ? 'danger' : 'success';
            $status= $property->status == 0 ? 'Deactive' : 'Active';
            return  '<a href="#" id="currentStatus'. $property->id .'"><span
                                                        class="badge rounded-pill bg-'.$btn.'">'.$status.'</span></a>';
        })
            ->addColumn('change', function (Property $property) {              
            $checked = $property->status == 1 ? 'checked' : '';
                return  '<input data-id="'. $property->id .'" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="Deactive"
                                                    '. $checked.'>';
            })
                ->addColumn('action', function (Property $property) {
                    $url = url('property/details/'.$property->id.'/'.$property->property_slug);
                    $show=route('properties.show', $property->id) ;
                    $x =     \Collective\Html\FormFacade::open([
                        'method' => 'delete',
                        'route' => ['properties.destroy', $property->id],
                        'class' => 'forms-sample',
                    ]);
                    $x .= '<a href="'.$url . '" class="btn btn-inverse-info me-2" title="Public View"  target="_blank"> <i
                                                            data-feather="eye"></i> </a>';

                    $x .= '<a href="'.  $show. '"
                                                        class="btn btn-inverse-info me-2" title="List View"> <i
                                                            data-feather="monitor"></i> </a>';
                    $x .= '<a href="' . route('properties.edit', $property->id) . '" class="btn btn-inverse-warning me-2"><i data-feather="edit"></i></a>';
                    $x .= '<button type="submit" class="btn btn-inverse-danger btn-submit"><i
                                                            data-feather="trash-2"></i></button>';
                    $x .=  \Collective\Html\FormFacade::close();
                    return $x;
                })

                ->rawColumns(['image', 'uploadby', 'info', 'status', 'change', 'action'])
                ->make(true);
       
    }
}
