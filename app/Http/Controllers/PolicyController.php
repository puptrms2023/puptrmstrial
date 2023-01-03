<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function privacy_policy()
    {
        $data['app_url'] = config('app.url');
        return view('others.privacy_policy', $data);
    }

    public function terms_of_use()
    {
        $data['app_url'] = config('app.url');
        return view('others.terms_of_use', $data);
    }
}
