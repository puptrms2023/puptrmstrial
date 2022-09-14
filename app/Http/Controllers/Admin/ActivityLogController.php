<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activity = Audit::all();
        return view('admin.user-activity-log.index', compact('activity'));
    }
}
