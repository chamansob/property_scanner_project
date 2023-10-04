<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Propertysize;
use Illuminate\Http\Request;

class PropertysizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $property_sizes = Propertysize::latest()->get();
        return view('backend.property_size.all_property_size', compact('property_sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.property_size.add_property_size');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:propertysizes|max:200',
        ]);

        PropertySize::insert([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Property Size Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(propertysize $propertysize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(propertysize $propertysize)
    {
        return view('backend.property_size.edit_property_size', compact('propertysize'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, propertysize $propertysize)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
        ]);

        $propertysize->update([
            'name' => $request->name
        ]);
        $notification = array(
            'message' => 'Property Size Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(propertysize $propertysize)
    {
        $propertysize->delete();
        $notification = array(
            'message' => 'Property Size Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
