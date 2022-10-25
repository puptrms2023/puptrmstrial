<?php

namespace App\Http\Controllers\Admin\Applicant;

use App\Models\User;
use App\Models\NonAcadAward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NonAcademicApplicant;
use App\Notifications\NonAcademicStatus;
use App\Notifications\StudentApplicantStatus;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

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

    public function approved($nonacad_id, $id)
    {
        $approve = NonAcademicApplicant::find($id);
        $users = User::where('id', $approve->user_id)->get();
        $award = $approve->nonacad->nonacad_code;
        $approve->status = 1;

        $approve->save();

        Notification::send($users, new StudentApplicantStatus($approve->id, $approve->status, $award));
        return redirect()->back();
    }
    public function rejected($nonacad_id, $id)
    {
        $reject = NonAcademicApplicant::find($id);
        $users = User::where('id', $reject->user_id)->get();
        $award = $reject->nonacad->nonacad_code;
        $reject->status = 2;

        $reject->save();

        Notification::send($users, new StudentApplicantStatus($reject->id, $reject->status, $award));
        return redirect()->back();
    }

    public function update(Request $request, $nonacad_id, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'reason' => 'nullable'
        ]);
        $status = NonAcademicApplicant::findOrFail($id);

        $status->status = $request->status;
        $status->reason = $request->reason;
        $award = $status->nonacad->nonacad_code;

        $users = User::where('id', $status->user_id)->get();
        $status->save();
        if ($request->status == '1' || $request->status == '2') {
            Notification::send($users, new StudentApplicantStatus($status->id, $request->status, $award));
        }

        return redirect()->back()->with('success', 'The Application form updated successfully');
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
