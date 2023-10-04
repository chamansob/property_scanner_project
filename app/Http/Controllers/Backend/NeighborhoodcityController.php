<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Neighborhoodcity;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NeighborhoodcitiesExport;
use App\Imports\NeighborhoodcitiesImport;

class NeighborhoodcityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $neighborhoodcity = Neighborhoodcity::latest()->get();
        return view('backend.neighborhoodcity.all_neighborhoodcity', compact('neighborhoodcity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id')->toArray();
        $states = State::pluck('name', 'id')->toArray();
        $cites = City::pluck('name', 'id')->toArray();
        $neighborhoodcity = [];
        return view('backend.neighborhoodcity.add_neighborhoodcity', compact('countries', 'states', 'cites','neighborhoodcity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:neighborhoodcities|max:200',
        ]);

        Neighborhoodcity::insert([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'status' => 0,
        ]);
        $notification = array(
            'message' => 'Neighborhood City Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(neighborhoodcity $neighborhoodcity)
    {
       }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(neighborhoodcity $neighborhoodcity)
    {
        $countries = Country::pluck('name', 'id')->toArray();
        $states = State::pluck('name', 'id')->toArray();
        $cites = City::pluck('name', 'id')->toArray();
        return view('backend.neighborhoodcity.edit_neighborhoodcity', compact('countries', 'states', 'cites', 'neighborhoodcity'));
     }
     
    public function StatusUpdate(neighborhoodcity $neighborhoodcity)
    {
        $neighborhoodcity->update([
            'status' => ($neighborhoodcity->status == 1) ? 0 : 1,
        ]);
        $notification = array(
            'message' => 'Neighborhood City Status Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('neighborhoodcities.index')->with($notification);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, neighborhoodcity $neighborhoodcity)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
        ]);

        $neighborhoodcity->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'country_id' => $request->country_id,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'City Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(neighborhoodcity $neighborhoodcity)
    {
        $neighborhoodcity->delete();
        $notification = array(
            'message' => 'Neighborhood City Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function states()
    {
        $allstates = '';
        $id = $_POST['country_id'];
        $states = State::where('country_id', $id)->get();

        echo '<option selected="selected">---Select State---</option>';
        foreach ($states as $state) {
            $allstates .= '<option value="' . $state->id . '">' . $state->id . '. ' . ucfirst($state->name) . '</option>';
        }
        return ($allstates);
    }
    
    public function cities()
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
    public function ImportPermission()
    {

        return view('backend.pages.neighborhoodcities.import_neighborhoodcities');
    } // End Method 

    public function Export()
    {
        return Excel::download(new NeighborhoodcitiesExport, 'neighborhoodcities.xlsx');
    } // End Method 
    public function Import(Request $request)
    {

        Excel::import(new NeighborhoodcitiesImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Neighborhood Cities Imported Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 
}
