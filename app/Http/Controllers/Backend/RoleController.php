<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use App\Models\User;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.permission.add_permission');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permission = Permission::create([
            'name' => strtolower($request->name),
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permission.create')->with($notification);
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
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $per_id = $id;

        Permission::findOrFail($per_id)->update([
            'name' => strtolower($request->name),
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permission.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function ImportPermission()
    {

        return view('backend.pages.permission.import_permission');
    } // End Method 

    public function Export()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    } // End Method 
    public function Import(Request $request)
    {

        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Permission Imported Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 
    public function AddRolesPermission()
    {

        $roles = Role::orderBy('id')->pluck('name', 'id');
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    } // End Method 
    public function RolePermissionStore(Request $request)
    {

        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        } // end foreach 

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    } // End Method 
    public function AllRolesPermission()
    {

        $roles = Role::all();
        return view('backend.pages.rolesetup.all_roles_permission', compact('roles'));
    } // End Method 
    public function AdminEditRoles($id)
    {

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));
    } // End Method 
    public function AdminRolesUpdate(Request $request, $id)
    {

        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    } // End Method
    public function AdminDeleteRoles($id)
    {

        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }

        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
    public function Ajax_Data(Request $request)
    {
        
        if($request->ajax())
        {
        $query = Permission::select('id', 'name', 'group_name')->get();

        return DataTables::of($query)
            ->addColumn('sl', function (Permission $permission) {
                return  $permission->id;
            })
            ->addColumn('name', function (Permission $permission) {
                return  !empty($permission->name) ? $permission->name : '-';
            })
            ->addColumn('group_name', function (Permission $permission) {
                return  !empty($permission->group_name) ? $permission->group_name : '-';
            })

            ->addColumn('action', function (Permission $permission) {

                $x =     \Collective\Html\FormFacade::open([
                    'method' => 'delete',
                    'route' => ['permission.destroy', $permission->id],
                    'class' => 'forms-sample',
                ]);
                $x .= '<a href="' . route('permission.edit', $permission->id) . '" class="btn btn-inverse-warning me-2">Edit</a>';
                $x .= '<button type="submit" class="btn btn-inverse-danger btn-submit">Delete</button>';
                $x .=  \Collective\Html\FormFacade::close();
                return $x;
            })

            ->rawColumns(['action'])
            ->make(true);
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
}
