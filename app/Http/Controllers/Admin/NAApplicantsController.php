<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NonAcademicApplicant;
use Illuminate\Support\Facades\File;

class NAApplicantsController extends Controller
{
    public function leadership()
    {
        $form = NonAcademicApplicant::where('nonacad_id', '1')->get();
        return view('admin.non-academic-award.leadership-award.index', compact('form'));
    }

    // leadership award
    public function showLeadership($id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.leadership-award.view', compact('form'));
    }

    public function destroyLeadership(Request $request)
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

    //Athlete of the year award
    public function athlete()
    {
        $form = NonAcademicApplicant::where('nonacad_id', '2')->get();
        return view('admin.non-academic-award.athlete-of-the-year.index', compact('form'));
    }

    public function showAthlete($id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.athlete-of-the-year.view', compact('form'));
    }

    public function destroyAthlete(Request $request)
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

    //outstanding organization award
    public function outstanding()
    {
        $form = NonAcademicApplicant::where('nonacad_id', '3')->get();
        return view('admin.non-academic-award.outstanding-organization-award.index', compact('form'));
    }

    public function showOutstanding($id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.outstanding-organization-award.view', compact('form'));
    }

    public function destroyOutstanding(Request $request)
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

    //best thesis award
    public function thesis()
    {
        $form = NonAcademicApplicant::where('nonacad_id', '4')->get();
        return view('admin.non-academic-award.best-thesis-award.index', compact('form'));
    }

    public function showThesis($id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.best-thesis-award.view', compact('form'));
    }

    public function destroyThesis(Request $request)
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

    //graduating organization presidents
    public function presidents()
    {
        $form = NonAcademicApplicant::where('nonacad_id', '5')->get();
        return view('admin.non-academic-award.graduating-organization-presidents.index', compact('form'));
    }

    public function showPresidents($id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.graduating-organization-presidents.view', compact('form'));
    }

    public function destroyPresidents(Request $request)
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
    //student assistants
    public function sa()
    {
        $form = NonAcademicApplicant::where('nonacad_id', '6')->get();
        return view('admin.non-academic-award.graduating-sa.index', compact('form'));
    }

    public function showSa($id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.graduating-sa.view', compact('form'));
    }

    public function destroySa(Request $request)
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

    //Outide Competition
    public function competition()
    {
        $form = NonAcademicApplicant::where('nonacad_id', '7')->get();
        return view('admin.non-academic-award.outside-competition.index', compact('form'));
    }

    public function showCompetition($id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.outside-competition.view', compact('form'));
    }

    public function destroyCompetition(Request $request)
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
    //Dance
    public function dance()
    {
        $form = NonAcademicApplicant::where('nonacad_id', '8')->get();
        return view('admin.non-academic-award.pupt-dance-troupe.index', compact('form'));
    }

    public function showDance($id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.pupt-dance-troupe.view', compact('form'));
    }

    public function destroyDance(Request $request)
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
    //Dance
    public function choral()
    {
        $form = NonAcademicApplicant::where('nonacad_id', '9')->get();
        return view('admin.non-academic-award.pupt-choral-group.index', compact('form'));
    }

    public function showChoral($id)
    {
        $form = NonAcademicApplicant::find($id);
        return view('admin.non-academic-award.pupt-choral-group.view', compact('form'));
    }

    public function destroyChoral(Request $request)
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
}
