<?php

namespace App\Http\Controllers\Admin\ActivityLog;

use App\Http\Controllers\Controller;
use App\Models\Audit as ModelsAudit;
use App\Models\User;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class ActivityLogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu activity log', ['only' => ['index', 'deleteAll', 'destroy']]);
    }

    public function index()
    {
        $activity = ModelsAudit::with('user')->orderBy('id', 'desc')->get();
        // dd($activity);
        return view('admin.user-activity-log.index', compact('activity'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Audit::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'Activity log deleted successfully'
        ]);
    }

    public function destroy(Request $request)
    {
        $activity = Audit::find($request->log_delete_id);
        $activity->delete();
        return redirect()->back()->with('success', 'Activity log deleted successfully');
    }
}
