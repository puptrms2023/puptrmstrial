<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class ActivityLogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu activity log', ['only' => ['index']]);
    }
    public function index()
    {
        $activity = Audit::orderBy('id', 'desc')->get();
        return view('admin.user-activity-log.index', compact('activity'));
    }
}
