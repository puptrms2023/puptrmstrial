<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Models\Signature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sign;

class SignatureController extends Controller
{
    public function index()
    {
        $sig = Signature::all();
        return view('admin.maintenance.signatures.index', compact('sig'));
    }

    public function create()
    {
        return view('admin.maintenance.signatures.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'position' => 'required',
            'signed' => 'nullable'
        ]);

        $folderPath = public_path('uploads/signature/');

        $image_parts = explode(";base64,", $request->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $signature = uniqid() . '.' . $image_type;

        $file = $folderPath . $signature;

        file_put_contents($file, $image_base64);

        $sign = new Signature;
        $sign->name = $request->name;
        $sign->position = $request->position;
        $sign->signature = $signature;
        $sign->save();

        return back()->with('success', 'Form successfully submitted with signature');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'position' => 'required'
        ]);

        $sign = Signature::find($id);
        $sign->name = $request->name;
        $sign->position = $request->position;

        $sign_signature = $request->old_signature;

        if (!empty($request->signed)) {
            unlink(public_path('uploads/signature/' . $sign_signature));

            $folderPath = public_path('uploads/signature/');

            $image_parts = explode(";base64,", $request->signed);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $signature = uniqid() . '.' . $image_type;

            $file = $folderPath . $signature;

            file_put_contents($file, $image_base64);

            $sign->signature = $signature;
        } else {
            $sign->signature = $request->old_signature;
        }

        $sign->save();

        return back()->with('success', 'Name successfully updated with signature');
    }

    public function edit($id)
    {
        $sig = Signature::find($id);
        return view('admin.maintenance.signatures.edit', compact('sig'));
    }
}
