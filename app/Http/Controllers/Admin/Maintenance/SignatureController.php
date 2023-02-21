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
        $this->middleware('permission:menu module', ['only' => ['index', 'edit', 'update', 'create']]);
        $this->middleware('permission:signature list', ['only' => ['index', 'edit', 'update', 'create']]);
        $this->middleware('permission:signature create', ['only' => ['create', 'store']]);
        $this->middleware('permission:signature edit', ['only' => ['edit', 'update', 'changeStatusCertificate', 'changeStatusReports']]);
        $this->middleware('permission:signature delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $sig = Signature::orderBy('id', 'desc')->get();
        return view('admin.maintenance.signatures.index', compact('sig'));
    }

    public function create()
    {
        return view('admin.maintenance.signatures.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:signatures,rep_name',
            'position' => 'required',
            'signed' => 'nullable',
            'image_signature' => 'nullable|mimes:jpeg,png,jpg,svg'
        ]);

        $sign = new Signature;

        $folderPath = public_path('uploads/signature/');

        if ($request->has('signed') && !empty($request->signed)) {
            // Handle signed request
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.' . $image_type;
            $file = $folderPath . $signature;
            file_put_contents($file, $image_base64);
            $sign->signature = $signature;
        } elseif ($request->hasFile('image_signature')) {
            // Handle image_signature request
            $file = $request->file('image_signature');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move($folderPath, $filename);
            $sign->signature = $filename;
        }

        $sign->rep_name = $request->name;
        $sign->position = $request->position;
        $sign->save();

        return redirect('admin/maintenance/signatures')->with('success', 'Form successfully submitted with signature');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:signatures,rep_name,' . $id,
            'position' => 'required',
            'signed' => 'nullable',
            'image_signature' => 'nullable|mimes:jpeg,png,jpg,svg'
        ]);

        $sign = Signature::findOrFail($id);
        $sign->rep_name = $request->name;
        $sign->position = $request->position;

        $sign_signature = $request->old_signature;

        $filePath = public_path('uploads/signature/');

        if (!empty($request->signed)) {
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

            $sign->signature = $signature;
        } elseif ($request->hasFile('image_signature')) {
            if (file_exists($filePath . $sign_signature)) {
                @unlink($filePath . $sign_signature);
            }
            $file = $request->file('image_signature');
            $signature = time() . '.' . $file->getClientOriginalExtension();
            $file->move($filePath, $signature);

            $sign->signature = $signature;
        }

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
        $sign = Signature::find($request->sig_id);
        $cert_status = Signature::where('certificate', '1')->count();

        if ($request->status == '1') {
            if ($cert_status == 4) {
                return response()->json(['error' => 'You are allowed to check a maximum of 4 options.']);
            } else {
                $sign->certificate = $request->status;
            }
        }

        if ($request->status == '0') {
            $sign->certificate = $request->status;
        }

        $sign->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
    public function changeStatusReports(Request $request)
    {
        $sign = Signature::find($request->rep_id);
        $report_status = Signature::where('report', '1')->count();

        if ($request->status == '1') {
            if ($report_status == 4) {
                return response()->json(['error' => 'You are allowed to check a maximum of 4 options.']);
            } else {
                $sign->report = $request->status;
            }
        }

        if ($request->status == '0') {
            $sign->report = $request->status;
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

    public function destroyImage(Request $request)
    {
        $form = Signature::find($request->signature_delete_id);
        $filename = public_path() . '/uploads/signature/' . $form->signature;
        File::delete($filename);

        $form->signature = null;
        $form->save();
        return redirect()->back()->with('success', 'Signature deleted successfully');
    }
}
