<?php

namespace App\Http\Controllers\User\Profile;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Rules\StrMustContain;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $course = Courses::pluck('course', 'id');
        return view('user.profile.index', compact('course'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'middle_name' => 'nullable|max:255|regex:/^([^0-9]*)$/',
            'last_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'course_id' => 'required',
            'stud_num' => ['required', 'unique:users,stud_num,' . $id, 'max:15', new StrMustContain('TG')],
            'username' => 'required|alpha_dash|unique:users,username,' . $id,
            'email' => 'required|email:rfc,dns|unique:users,email,' . $id
        ]);

        $user = User::findOrFail($id);

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->contact = $request->contact;
        $user->course_id = $request->course_id;
        $user->stud_num = $request->stud_num;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();
        return redirect('user/profile')->with('success', 'Profile updated successfully');
    }
}
