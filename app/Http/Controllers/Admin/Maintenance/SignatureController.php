<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Models\Signature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sign;

class SignatureController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu module', ['only' => ['index', 'edit', 'update']]);
        $this->middleware('permission:signature list', ['only' => ['index', 'edit', 'update']]);
        $this->middleware('permission:signature edit', ['only' => ['edit', 'update']]);
    }
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
        $sign->rep_name = $request->name;
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

        $sign = Signature::findOrFail($id);
        $sign->rep_name = $request->name;
        $sign->position = $request->position;

        $sign_signature = $request->old_signature;

        if (!empty($request->signed)) {
            $filePath = public_path('uploads/signature/');
            if (file_exists($filePath . $sign_signature)) {
                @unlink($filePath . $sign_signature);
            }

            $image_parts = explode(";base64,", $request->signed);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $signature = uniqid() . '.' . $image_type;

            $file = $filePath . $signature;

            file_put_contents($file, $image_base64);

            $imageName = $signature;
        } else {
            $imageName = $sign_signature;
        }

        $sign->signature = $imageName;
        $sign->save();

        return back()->with('success', 'Name successfully updated with signature');
    }

    public function edit($id)
    {
        $sig = Signature::findOrFail($id);
        return view('admin.maintenance.signatures.edit', compact('sig'));
    }

    // public function checkbox(Request $request)
    // {
    //     $request->validate([
    //         'certificate' => 'nullable',
    //         'report' => 'nullable'
    //     ]);

    //     $user = new();
    //     if ($request->has('certificate')) {
    //         $cert = $request->certificate;
    //     }

    //     if ($request->has('report')) {
    //         $rep = $request->report;
    //     }

    //     $user->update(['certificate', $cert]);
    //     return back()->with('success', 'Successfully updated');
    // }
}
