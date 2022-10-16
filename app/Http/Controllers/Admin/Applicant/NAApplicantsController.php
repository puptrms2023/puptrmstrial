<?php

namespace App\Http\Controllers\Admin\Applicant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NonAcadAward;
use App\Models\NonAcademicApplicant;
use Illuminate\Support\Facades\File;

class NAApplicantsController extends Controller
{
    public function index()
    {
        $nonacad = NonAcadAward::all();
        $total = NonAcademicApplicant::count();
        return view('admin.non-academic-award.index', compact('total', 'nonacad'));
    }

    public function details($nonacad_id, $id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.show', compact('form'));
    }

    public function overallList()
    {
        $form = NonAcademicApplicant::all();
        return view('admin.non-academic-award.all', compact('form'));
    }

    public function view($id)
    {
        $title = NonAcadAward::where('id', $id)->first();
        $form = NonAcademicApplicant::where('nonacad_id', $id)->get();

        return view('admin.non-academic-award.view', compact('title', 'form'));
    }

    public function destroy(Request $request)
    {
        $form = NonAcademicApplicant::find($request->form_delete_id);
        if ($form->image) {
            $path = 'uploads/' . $form->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $form->delete();
        return redirect()->back()->with('success', 'The Application form deleted successfully');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        NonAcademicApplicant::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'User deleted successfully'
        ]);
    }
}
