<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Rules\StrMustContain;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu utilities', ['only' => ['index', 'create', 'edit']]);
        $this->middleware('permission:user list', ['only' => ['index', 'create', 'edit']]);
        $this->middleware('permission:user create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::where('role_as', '2')->orWhere('role_as', '1')->orWhere('role_as', '3')->get();
        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $course = Courses::pluck('course', 'id');
        return view('admin.user.create', compact('course', 'roles'));
    }

    public function store(UserFormRequest $request)
    {
        $validatedData = $request->validated();
        $user = new User;
        $user->username = $validatedData['username'];
        $user->first_name = $validatedData['first_name'];
        $user->middle_name = $validatedData['middle_name'];
        $user->last_name = $validatedData['last_name'];
        $user->contact = $validatedData['contact'];
        $user->course_id = $validatedData['course_id'];
        $user->stud_num = $validatedData['stud_num'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->role_as = 2;
        $user->save();
        $user->assignRole($validatedData['roles']);

        return redirect('admin/users')->with('success', 'User added successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $course = Courses::pluck('course', 'id');
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('admin.user.edit', compact('user', 'course', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'middle_name' => 'nullable|max:255|regex:/^([^0-9]*)$/',
            'last_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'password' => 'nullable|alpha_num|min:6',
            'course_id' => 'required',
            'roles' => 'required',
            'stud_num' => ['required', 'unique:users,stud_num,' . $id, 'max:15', new StrMustContain('TG')],
            'username' => 'required|alpha_dash|unique:users,username,' . $id,
            'email' => 'required|email:rfc,dns|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8'
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = $input['password'];
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();

        $user->assignRole($request->roles);

        return redirect('admin/users')->with('success', 'User updated successfully');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->user_delete_id);
        $user->delete();
        return redirect('admin/users')->with('success', 'User deleted successfully');
    }
}
