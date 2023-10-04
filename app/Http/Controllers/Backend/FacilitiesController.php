<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $facilities = Facility::latest()->get();
        return view('backend.facilities.all_facilities', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.facilities.add_facilities');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated =  $request->validate([
            'facility_name' => 'required|unique:facilities|max:200',            
        ]);

        Facility::insert([
            'facility_name' => $request->facility_name,          
        ]);

        $notification = array(
            'message' => 'Facilities Create Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $Facilities)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {        
        
        return view('backend.facilities.edit_facilities', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
       $validated =  $request->validate([
            'facility_name' => 'required|max:200',           
        ]);

        $facility->update([
            'facility_name' => $request->facility_name,
           
        ]);
        $notification = array(
            'message' => 'Facilities Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();
         $notification = array(
            'message' => 'Facilities Deleted successfully',
            'alert-type' => 'success',
        );
         return redirect()->route('facilities.index')->with($notification);
    }
}
