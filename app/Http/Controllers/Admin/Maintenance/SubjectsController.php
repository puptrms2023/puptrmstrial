<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectCreateRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu module', ['only' => ['index', 'create', 'edit', 'update', 'destroy', 'deleteAll']]);
        $this->middleware('permission:subject list', ['only' => ['index', 'edit', 'create']]);
        $this->middleware('permission:subject create', ['only' => ['create', 'store']]);
        $this->middleware('permission:subject edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:subject delete', ['only' => ['destroy', 'deleteAll']]);
    }

    public function index()
    {
        $subjects = Subject::all();
        return view('admin.maintenance.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.maintenance.subjects.create');
    }

    public function store(SubjectCreateRequest $request)
    {
        $validatedData = $request->validated();
        $subjects = new Subject();
        $subjects->s_code = $validatedData['course_code'];
        $subjects->s_name = $validatedData['course_description'];
        $subjects->save();

        return redirect('admin/maintenance/subjects/create')->with('success', 'Subject added successfully');
    }

    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('admin.maintenance.subjects.edit', compact('subject'));
    }

    public function update(SubjectUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $subjects = Subject::find($id);
        $subjects->s_code = $validatedData['course_code'];
        $subjects->s_name = $validatedData['course_description'];
        $subjects->save();

        return redirect('admin/maintenance/subjects')->with('success', 'Subject updated successfully');
    }

    public function destroy(Request $request)
    {
        $course = Subject::find($request->sub_delete_id);
        $course->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully');
    }
}
