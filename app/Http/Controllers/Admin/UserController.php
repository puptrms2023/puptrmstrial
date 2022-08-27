<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\StrMustContain;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $user = new User;
        $user->username = $validatedData['username'];
        $user->first_name = $validatedData['first_name'];
        $user->middle_name = $validatedData['middle_name'];
        $user->last_name = $validatedData['last_name'];
        $user->contact = $validatedData['contact'];
        $user->course = $validatedData['course'];
        $user->stud_num = $validatedData['stud_num'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->save();

        return redirect('admin/users')->with('message', 'User Added Successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'middle_name' => 'nullable|max:255|regex:/^([^0-9]*)$/',
            'last_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'course' => 'required',
            'role_as' => 'required',
            'stud_num' => ['required', 'unique:users,stud_num', 'max:15', new StrMustContain('TG')],
            'username' => 'required|alpha_dash|unique:users,username,' . $id,
            'email' => 'required|email:rfc,dns|unique:users,email,' . $id
        ]);

        $user = User::findOrFail($id);

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->contact = $request->contact;
        $user->course = $request->course;
        $user->role_as = $request->role_as;
        $user->stud_num = $request->stud_num;
        $user->username = $request->username;
        $user->email = $request->email;

        // if($request->has('password')){
        //     $user->password = bcrypt($request->password);
        // }

        $user->save();
        return redirect('admin/users')->with('message', 'User Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->user_delete_id);
        $user->delete();
        return redirect('admin/users')->with('message', 'User Deleted Successfully');
    }
}
