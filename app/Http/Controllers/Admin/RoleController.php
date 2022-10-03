<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu utilities', ['only' => ['index', 'create', 'edit']]);
        $this->middleware('permission:role list', ['only' => ['index', 'create', 'edit']]);
        $this->middleware('permission:role create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::where('name', '!=', 'Super-Admin')->orderBy('id', 'desc')->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $category = Category::with('permission')->get();
        return view('admin.roles.create', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect('admin/roles')->with('success', 'Role created successfully');
    }

    public function edit($id)
    {
        $category = Category::with('permission')->get();
        $role = Role::find($id);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', compact('category', 'role', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect('admin/roles/' . $id)->with('success', 'Role updated successfully.');
    }

    public function destroy(Request $request)
    {
        $role = Role::find($request->role_delete_id);
        $role->delete();
        return redirect('admin/roles')->with('success', 'Role deleted successfully');
    }
}
