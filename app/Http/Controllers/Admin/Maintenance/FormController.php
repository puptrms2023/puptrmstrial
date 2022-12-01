<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Models\Form;
use App\Models\FormReq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu module', ['only' => ['index', 'edit', 'update']]);
        $this->middleware('permission:form list', ['only' => ['index', 'edit', 'update']]);
        $this->middleware('permission:form edit', ['only' => ['edit', 'update']]);
    }
    public function index()
    {
        $form = Form::with('requirement')->get();
        return view('admin.maintenance.form.index', compact('form'));
    }
    public function edit($id)
    {
        $form = Form::find($id);
        $requirements = FormReq::where('form_id', $id)->get();
        return view('admin.maintenance.form.edit', compact('form', 'requirements'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable',
            'requirements.*.title' => 'required',
        ]);

        $photo = $request->old_photo;
        $form = Form::find($id);
        if ($request->hasfile('photocard')) {
            $filePath = public_path('uploads/form/');
            if (file_exists($filePath . $photo)) {
                @unlink($filePath . $photo);
            }
            $file = $request->file('photocard');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/form/', $filename);
            $form->photocard = $filename;
        } else {
            $form->photocard = $request->old_photo;
        }

        $form->save();

        foreach ($request->requirements as $key => $requirements) {

            // Update
            if (isset($requirements['id']) && $requirements['id']) {
                $req = FormReq::find($requirements['id']);
                $req->requirements = $requirements['title'];
                // Create
            } else {
                $req = new FormReq();
                $req->requirements = $requirements['title'];
                $req->form_id = $id;
            }
            $req->save();
        }

        return back()->with('success', 'Record has been updated.');
    }

    public function destroy(Request $request)
    {
        $req = FormReq::find($request->req_delete_id);
        $req->delete();
        return redirect()->back()->with('success', 'Requirement deleted successfully');
    }
}
