<?php

namespace App\Http\Controllers\Admin\CSV;

use App\Models\SIS;
use App\Models\CsvData;
use Illuminate\Http\Request;
use App\Imports\AwardeesImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CsvImportRequest;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:menu csv', ['only' => ['index', 'parseImport', 'processImport', 'showParsed']]);
        $this->middleware('permission:csv list', ['only' => ['index', 'parseImport', 'processImport']]);
        $this->middleware('permission:csv create', ['only' => ['parseImport', 'processImport']]);
        $this->middleware('permission:csv delete', ['only' => ['destroy']]);
        $this->middleware('permission:parse list', ['only' => ['showParsed']]);
        $this->middleware('permission:parse delete', ['only' => ['destroySIS', 'deleteAll']]);
    }

    public function index()
    {
        $csv = CsvData::all();
        return view('admin.import-csv.index', compact('csv'));
    }

    public function parseImport(CsvImportRequest $request)
    {
        // Validate the header
        $headings = (new HeadingRowImport)->toArray($request->file('csv_file'));

        foreach ($headings[0] as $childArray) {
            $headerCount = count($childArray);
            // $count will be 13 for each iteration
        }

        if ($request->has('header') && $headerCount != count(expectedHeadings())) {
            return redirect()->back()->with('error', 'The CSV file has an invalid header');
        }


        // Continue with the rest of the import process
        if ($request->has('header')) {
            $data = Excel::toArray(new AwardeesImport, $request->file('csv_file'))[0];
        } else {
            $data = array_map('str_getcsv', file($request->file('csv_file')->getRealPath()));
        }

        if (count($data) > 0) {
            $csv_data = array_slice($data, 0, 6);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('admin.import-csv.import-fields', [
            'headings' => $headings ?? null,
            'csv_data' => $csv_data,
            'csv_data_file' => $csv_data_file
        ])->with('success', 'The CSV file imported successfully');
    }


    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $awardees = new SIS();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    $awardees->$field = $row[$request->fields[$field]];
                } else {
                    $awardees->$field = $row[$request->fields[$index]];
                }
            }
            $awardees->save();
        }
        return redirect()->action([ImportController::class, 'index'])->with('success', 'Import finished.');
    }

    public function destroy(Request $request)
    {
        $user = CsvData::find($request->file_delete_id);
        $user->delete();
        return redirect('admin/import-csv')->with('success', 'CSV file deleted successfully');
    }

    public function showParsed()
    {
        $data = SIS::orderBy('id', 'desc')->get();
        return view('admin.import-csv.parse-data', compact('data'));
    }

    public function destroySIS(Request $request)
    {
        $user = SIS::find($request->user_delete_id);
        $user->delete();
        return redirect('admin/parse-data')->with('success', 'Data deleted successfully');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        SIS::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'Data deleted successfully'
        ]);
    }
}
