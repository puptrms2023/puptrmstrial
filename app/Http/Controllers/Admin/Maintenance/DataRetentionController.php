<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\Retention;
use Illuminate\Http\Request;

class DataRetentionController extends Controller
{
    public function index()
    {
        $data_retention = Retention::orderBy('id', 'asc')->get();
        return view('admin.maintenance.data-retention.index', compact('data_retention'));
    }

    public function edit($id)
    {
        $data_retention = Retention::find($id);
        return view('admin.maintenance.data-retention.edit', compact('data_retention'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:retention,name,' . $id,
            'period' => 'required|integer|min:1',
            'duration' => 'required',
        ]);

        $fields = $request->all();
        $data_retention = Retention::findOrFail($id);
        $data_retention->update($fields);

        return back()->with('success', 'Record has been updated.');
    }
}
