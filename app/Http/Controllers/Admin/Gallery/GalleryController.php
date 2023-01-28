<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Models\Photo;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class GalleryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:gallery list', ['only' => ['index', 'create', 'show', 'edit', 'photoCreate', 'photoShow', 'photoDelete']]);
        $this->middleware('permission:gallery create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gallery edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gallery delete', ['only' => ['destroy']]);

        $this->middleware('permission:photo view', ['only' => ['show']]);
        $this->middleware('permission:photo create', ['only' => ['photoCreate', 'photoStore']]);
        $this->middleware('permission:photo edit', ['only' => ['photoEdit', 'photoUpdate']]);
        $this->middleware('permission:photo delete', ['only' => ['photoDelete']]);
    }

    public function index()
    {
        $galleries = Gallery::all();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:galleries,title',
            'cover' => 'required',
            'description' => 'required'
        ]);

        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->user_id = Auth::user()->id;

        $cover = $request->file('cover');
        $cover_ext = $cover->getClientOriginalExtension();
        $cover_name = rand(123456, 999999) . '.' . $cover_ext;
        $cover_path = public_path('uploads/galleries/');
        $cover->move($cover_path, $cover_name);

        $gallery->cover = $cover_name;
        $gallery->save();

        Gdrive::makeDir($request->title);
        return redirect('admin/galleries')->with('message', 'Gallery uploaded successfully');
    }

    public function show($id)
    {
        $gallery = Gallery::find($id);
        $photos = Photo::where('gallery_id', $gallery->id)->get();
        $folder = Gdrive::all($gallery->title);
        return view('admin.galleries.show', compact('gallery', 'photos', 'folder'));
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:galleries,title,' . $id,
            'cover' => 'nullable',
            'description' => 'required'
        ]);
        $gallery = Gallery::find($id);
        $gallery->title = $request->title;
        $gallery->description = $request->description;

        $gallery_cover = $gallery->cover;
        if ($request->hasFile('cover')) {
            unlink(public_path('uploads/galleries/' . $gallery_cover));

            $cover = $request->file('cover');
            $cover_ext = $cover->getClientOriginalExtension();
            $cover_name = rand(123456, 999999) . '.' . $cover_ext;
            $cover_path = public_path('uploads/galleries/');
            $cover->move($cover_path, $cover_name);
            $gallery->cover = $cover_name;
        } else {
            $gallery->cover = $request->old_cover;
        }
        $gallery->save();

        return redirect('admin/galleries/show/' . $id)->with('success', 'Gallery updated successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->image_delete_id;
        DB::table('photos')->where('gallery_id', $id)->delete();
        $gallery = Gallery::find($id);
        $gallery_cover = $gallery->cover;
        unlink(public_path('uploads/galleries/') . $gallery_cover);
        $gallery->delete();

        Gdrive::deleteDir($gallery->title);

        return redirect('admin/galleries')->with('success', 'Gallery deleted successfully');
    }

    //photo mnethod
    public function photoCreate($id)
    {
        $gallery = Gallery::find($id);
        return view('admin.galleries.photos.create', compact('gallery'));
    }

    public function photoStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'photo' => 'required',
            'description' => 'required'
        ]);

        $photo = $request->file('photo');
        $photo_ext = $photo->getClientOriginalExtension();
        $photo_name = rand(123456, 999999) . '.' . $photo_ext;
        $photo_path = public_path('uploads/galleries/photos/');
        $photo->move($photo_path, $photo_name);

        $photoModel = new Photo();
        $photoModel->title = $validatedData['title'];
        $photoModel->description = $validatedData['description'];
        $photoModel->gallery_id = $request->get('gallery_id');
        $photoModel->photo = $photo_name;
        $photoModel->save();

        //saving image in google drive
        $filepath = public_path() . '/uploads/galleries/photos/' . $photo_name;
        $filename = $request->get('folder_name') . '/' . $photo_name;
        Storage::disk('google')->put($filename, File::get($filepath));

        //delete image in public path
        unlink(public_path('uploads/galleries/photos/') . $photo_name);

        return redirect('admin/galleries/show/' . $request->get('gallery_id'))
            ->with('success', 'File was saved to Google Drive');
    }

    public function photoShow($gallery_name, $photo_name)
    {
        $photo = Photo::where('photo', $photo_name)->first();
        return view('admin.galleries.photos.show', compact('photo'));
    }

    public function photoEdit($gallery_name, $photo_name)
    {
        $photo = Photo::where('photo', $photo_name)->first();
        return view('admin.galleries.photos.edit', compact('photo'));
    }

    public function photoUpdate(Request $request, $id)
    {
        $photo = Photo::find($id);

        $photo->title = $request->title;
        $photo->description = $request->description;

        $photo_name = $photo->photo;

        if ($request->hasFile('photo')) {

            Gdrive::delete($photo->gallery->title . '/' . $photo_name);

            $new_photo = $request->file('photo');
            $new_photo_ext = $new_photo->getClientOriginalExtension();
            $new_photo_name = rand(123456, 999999) . '.' . $new_photo_ext;
            $new_photo_path = public_path('uploads/galleries/photos/');
            $new_photo->move($new_photo_path, $new_photo_name);
            $photo->photo = $new_photo_name;

            $filepath = public_path() . '/uploads/galleries/photos/' . $new_photo_name;
            $filename = $photo->gallery->title . '/' . $new_photo_name;
            Storage::disk('google')->put($filename, File::get($filepath));

            unlink(public_path('uploads/galleries/photos/') . $new_photo_name);
        } else {
            $photo->photo = $request->old_photo;
        }

        $photo->save();

        return redirect('admin/galleries/' . $filename . '/show')->with('success', 'Photo updated successfully');
    }

    public function photoDelete(Request $request)
    {
        $photo = Photo::with('gallery')->where('id', $request->image_delete_id)->first();
        $photo_name = $photo->photo;
        $gallery_id = $photo->gallery_id;

        Gdrive::delete($photo->gallery->title . '/' . $photo_name);
        $photo->delete();

        return redirect('admin/galleries/show/' . $gallery_id)->with('success', 'Photo deleted successfully');
    }
}
