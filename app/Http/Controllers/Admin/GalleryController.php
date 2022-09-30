<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
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
            'title' => 'required',
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
        return redirect('admin/galleries')->with('message', 'Gallery uploaded successfully');
    }

    public function show($id)
    {
        $gallery = Gallery::find($id);
        $photos = Photo::where('gallery_id', $gallery->id)->get();
        return view('admin.galleries.show', compact('gallery', 'photos'));
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
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
        $photos = Photo::where('gallery_id', $id)->get();
        foreach ($photos as $photo) {
            $photo_name = $photo->photo;
            unlink(public_path('uploads/galleries/photos/' . $photo_name));
        }
        DB::table('photos')->where('gallery_id', $id)->delete();
        $gallery = Gallery::find($id);
        $gallery_cover = $gallery->cover;
        unlink(public_path('uploads/galleries/') . $gallery_cover);
        $gallery->delete();
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
        $this->validate($request, [
            'title' => 'required',
            'photo' => 'required',
            'description' => 'required'
        ]);

        $photos = new Photo();
        $gallery_id = $request->gallery_id;

        $photos->title = $request->title;
        $photos->description = $request->description;
        $photos->gallery_id = $gallery_id;

        $photo = $request->file('photo');
        $photo_ext = $photo->getClientOriginalExtension();
        $photo_name = rand(123456, 999999) . '.' . $photo_ext;
        $photo_path = public_path('uploads/galleries/photos/');
        $photo->move($photo_path, $photo_name);
        $photos->photo = $photo_name;
        $photos->save();
        return redirect('admin/galleries/show/' . $gallery_id)->with('success', 'Photos uploaded successfully');
    }

    public function photoShow($id)
    {
        $photo = Photo::find($id);
        return view('admin.galleries.photos.show', compact('photo'));
    }

    public function photoEdit($id)
    {
        $photo = Photo::find($id);
        return view('admin.galleries.photos.edit', compact('photo'));
    }

    public function photoUpdate(Request $request, $id)
    {
        $photo = Photo::find($id);
        $photo->title = $request->title;
        $photo->description = $request->description;

        $photo_name = $photo->photo;

        if ($request->hasFile('photo')) {

            unlink(public_path('uploads/galleries/photos/') . $photo_name);
            $new_photo = $request->file('photo');
            $new_photo_ext = $new_photo->getClientOriginalExtension();
            $new_photo_name = rand(123456, 999999) . '.' . $new_photo_ext;
            $new_photo_path = public_path('uploads/galleries/photos/');
            $new_photo->move($new_photo_path, $new_photo_name);
            $photo->photo = $new_photo_name;
        } else {
            $photo->photo = $request->old_photo;
        }

        $photo->save();
        return redirect('admin/galleries/photos/show/' . $id)->with('success', 'Photo updated successfully');
    }

    public function photoDelete(Request $request)
    {
        $photo = Photo::find($request->image_delete_id);
        $photo_name = $photo->photo;
        $gallery_id = $photo->gallery_id;
        unlink(public_path('uploads/galleries/photos/') . $photo_name);

        $photo->delete();
        return redirect('admin/galleries/show/' . $gallery_id)->with('success', 'Photo deleted successfully');
    }
}
