<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.usermanagement.user_activity_log', compact('users'));
    }
}
