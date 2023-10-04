<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('backend.pages.roles.all_roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.roles.add_roles');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role_id = $id;

        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
