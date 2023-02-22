<?php

namespace App\Http\Controllers\User\Gallery;

use App\Models\Photo;
use App\Models\Gallery;
use Illuminate\Http\Request;
use JoelButcher\Facebook\Facebook;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('photos')->orderBy('id', 'desc')->get();
        return view('user.gallery.index', compact('galleries'));
    }
}
