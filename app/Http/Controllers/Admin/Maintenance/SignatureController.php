<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Models\Signature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sign;

class SignatureController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu module', ['only' => ['index', 'edit', 'update','create']]);
        $this->middleware('permission:signature list', ['only' => ['index', 'edit', 'update','create']]);
        $this->middleware('permission:signature create', ['only' => ['create', 'store']]);
        $this->middleware('permission:signature edit', ['only' => ['edit', 'update','changeStatusCertificate','changeStatusReports']]);
        $this->middleware('permission:signature delete', ['only' => ['destroy']]);
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

        return redirect('admin/maintenance/signatures')->with('success', 'Form successfully submitted with signature');
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

    public function changeStatusCertificate(Request $request)
    {
        $sign = Signature::find($request->user_id);
        $cert_status = Signature::where('certificate', '1')->count();

        if ($request->certificate == '1') {
            if ($cert_status == 4) {
                return response()->json(['error' => 'You are allowed to check a maximum of 4 options.']);
            } else {
                $sign->certificate = $request->certificate;
            }
        }

        if ($request->certificate == '0') {
            $sign->certificate = $request->certificate;
        }

        $sign->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
    public function changeStatusReports(Request $request)
    {
        $sign = Signature::find($request->user_id);
        $report_status = Signature::where('report', '1')->count();

        if ($request->report == '1') {
            if ($report_status == 4) {
                return response()->json(['error' => 'You are allowed to check a maximum of 4 options.']);
            } else {
                $sign->report = $request->report;
            }
        }

        if ($request->report == '0') {
            $sign->report = $request->report;
        }

        $sign->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function destroy(Request $request)
    {
        $form = Signature::find($request->user_delete_id);
        if ($form->signature) {
            $path = 'uploads/signature/' . $form->signature;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $form->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
