<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
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
            unlink(public_path('uploads/form/' . $photo));
            $file = $request->file('photocard');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/form/', $filename);
            $form->photocard = $filename;
        } else {
            $form->photocard = $request->old_photo;
        }
        $form->requirements = $request->addMoreInputFields;
        $form->save();

        return back()->with('success', 'New subject has been added.');
    }
}
