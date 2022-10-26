<?php

namespace App\Http\Controllers\Admin\Records;

use App\Models\Record;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeleteRequest;
use App\Http\Requests\StoreDocumentRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RecordsController extends Controller
{
    public function index()
    {
        $document = Document::all();
        return view('admin.records.index', compact('document'));
    }

    public function show($id)
    {
        $document = Document::find($id);
        return view('admin.records.view', compact('document'));
    }
    public function create()
    {
        return view('admin.records.create');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function store(StoreDocumentRequest $request)
    {
        $document = Document::create($request->all());

        if ($request->input('document_file', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . $request->input('document_file')))->toMediaCollection('document_file');
        }

        return redirect('admin/records')->with('success', 'File uploaded successfully');
    }

    public function edit($id)
    {
        $document = Document::find($id);
        return view('admin.records.edit', compact('document'));
    }

    public function update(Request $request, $id, Document $document)
    {
        $document = Document::find($id);
        $document->update($request->all());

        if ($request->input('document_file', false)) { //if not empty
            if (!$document->document_file || $request->input('document_file') !== $document->document_file->file_name) {
                $document->addMedia(storage_path('tmp/uploads/' . $request->input('document_file')))->toMediaCollection('document_file');
            }
        } elseif ($document->document_file) { //if has exisitng value
            $document->document_file->delete();
        }

        return redirect('admin/records')->with('success', 'File updated successfully');
    }

    public function destroy(Request $request)
    {
        $document = Document::find($request->media_delete_id);
        $document->delete();
        return redirect('admin/records')->with('success', 'File deleted successfully');
    }

    public function deleteAll(MassDeleteRequest $request)
    {
        $ids = $request->ids;
        Document::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'File deleted successfully'
        ]);
    }
}
