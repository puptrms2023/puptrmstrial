<?php

namespace App\Http\Controllers\Admin;

use App\Models\SIS;
use App\Models\CsvData;
use Illuminate\Http\Request;
use App\Imports\AwardeesImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CsvImportRequest;
use Maatwebsite\Excel\HeadingRowImport;

class ImportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:csv list', ['only' => ['index', 'parseImport', 'processImport']]);
        $this->middleware('permission:csv create', ['only' => ['parseImport', 'processImport']]);
        $this->middleware('permission:csv delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $csv = CsvData::all();
        return view('admin.import-csv.index', compact('csv'));
    }

    public function parseImport(CsvImportRequest $request)
    {
        if ($request->has('header')) {
            $headings = (new HeadingRowImport)->toArray($request->file('csv_file'));
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
        ])->with('success', 'The CSV file imported successfully');;
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
}
