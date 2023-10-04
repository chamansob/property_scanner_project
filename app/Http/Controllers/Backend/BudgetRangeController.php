<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\BudgetRange;
use Illuminate\Http\Request;

class BudgetRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgetranges = BudgetRange::all();
        return view('backend.budgetrange.all_budgetrange', compact('budgetranges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.budgetrange.add_budgetrange');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
           
            'range_id' => 'required',
            'start' =>'required|max:200',
            'end' => 'required|max:200',
        ]);
       BudgetRange::insert([
            'range_id' => $request->range_id,
            'start' => $request->start,
            'end' => $request->end ,   
            'status' => 0,
        ]);
        $notification = array(
            'message' => 'Budget Range Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(BudgetRange $budgetRange)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BudgetRange $budgetrange)    {
        
       
        return view('backend.budgetrange.edit_budgetrange', compact('budgetrange'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BudgetRange $budgetrange)
    {
        $validated = $request->validate([
            'range_id' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        $budgetrange->update([
            'range_id' => $request->range_id,
            'start' => $request->start,
            'end' => $request->end          
           
        ]);
        $notification = array(
            'message' => 'Budget Range Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BudgetRange $budgetrange)
    {

        $budgetrange->delete();
        $notification = array(
            'message' => 'Budget Range Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function StatusUpdate(BudgetRange $budgetrange)
    {
      
        $budgetrange->update([
            'status' => ($budgetrange->status == 1) ? 0 : 1,
        ]);
        $notification = array(
            'message' => 'Budget Range Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
