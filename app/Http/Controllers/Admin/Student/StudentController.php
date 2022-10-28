<?php

namespace App\Http\Controllers\Admin\Student;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Rules\StrMustContain;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\AcademicExcellence;
use App\Models\NonAcadAward;
use App\Models\NonAcademicApplicant;
use App\Models\StudentApplicant;

class StudentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:student list', ['only' => ['index', 'show', 'create', 'edit']]);
        $this->middleware('permission:student edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:student delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $users = User::where('role_as', '0')->get();
        return view('admin.students.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $course = Courses::pluck('course', 'id');
        return view('admin.students.edit', compact('user', 'course'));
    }

    public function show($id)
    {
        $students = User::find($id);
        $academic = StudentApplicant::where('user_id', $id)->paginate(5);
        $excellence = AcademicExcellence::where('user_id', $id)->paginate(5);
        $non_acad = NonAcademicApplicant::where('user_id', $id)->paginate(5);
        return view('admin.students.show', compact('students', 'academic', 'excellence', 'non_acad'));
    }

    public function update(Request $request, $id)
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
        return redirect('admin/students')->with('success', 'Student updated successfully');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->user_delete_id);
        $user->delete();
        return redirect('admin/students')->with('success', 'Student deleted successfully');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'Student deleted successfully'
        ]);
    }
}
