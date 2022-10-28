<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu module', ['only' => ['index', 'show']]);
        $this->middleware('permission:about view', ['only' => ['index', 'show']]);
        $this->middleware('permission:about edit', ['only' => ['update', 'upload']]);
    }

    public function index()
    {
        $about = About::first();
        return view('admin.maintenance.about.index', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $about = About::find($id);
        $about->title = $request->title;
        $about->description = $request->description;
        $about->save();

        return redirect()->back()->with('success', 'Information updated successfully');
    }

    public function show()
    {
        $about = About::first();
        return view('admin.maintenance.about.show', compact('about'));
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->upload;
            $newName = time() . "." . $file->getClientOriginalExtension();
            $file->move("uploads", $newName);
            $url = asset("uploads/$newName");
            return response()->json(['fileName' => $newName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
