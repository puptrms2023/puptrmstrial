<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;

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
        $form = Form::all();
        return view('admin.maintenance.form.index', compact('form'));
    }
    public function edit($id)
    {
        $form = Form::find($id);
        return view('admin.maintenance.form.edit', compact('form'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable',
            'addMoreInputFields.*.requirement' => 'required'
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

        $form->requirements = $request->addMoreInputFields;
        $form->save();

        return back()->with('success', 'Record has been updated.');
    }
}
