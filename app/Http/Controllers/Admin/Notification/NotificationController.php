<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\StudentApplicant;
use App\Models\AcademicExcellence;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NonAcademicApplicant;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return view('admin.all-notifications.index');
    }

    public function showAA($id)
    {
        $getid = DB::table('notifications')->where('id', $id)->pluck('id');
        DB::table('notifications')->where('id', $getid)->update(['read_at' => now()]);

        return view('admin.achievers-award.overall');
    }

    public function showDL($id)
    {
        $getid = DB::table('notifications')->where('id', $id)->pluck('id');
        DB::table('notifications')->where('id', $getid)->update(['read_at' => now()]);

        return view('admin.deans-list-award.overall');
    }

    public function showPL($id)
    {
        $getid = DB::table('notifications')->where('id', $id)->pluck('id');
        DB::table('notifications')->where('id', $getid)->update(['read_at' => now()]);

        return view('admin.presidents-list-award.overall');
    }

    public function showAE($id)
    {
        $getid = DB::table('notifications')->where('id', $id)->pluck('id');
        DB::table('notifications')->where('id', $getid)->update(['read_at' => now()]);

        return view('admin.academic-excellence-award.overall');
    }
    public function showNA($id)
    {
        $form = NonAcademicApplicant::all();
        $getid = DB::table('notifications')->where('id', $id)->pluck('id');
        DB::table('notifications')->where('id', $getid)->update(['read_at' => now()]);
        return view('admin.non-academic-award.all', compact('form'));
    }

    public function markAsRead()
    {
        $user = User::find(Auth::id());
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        DB::table('notifications')->where('id', $request->notify_delete_id)->delete();
        return redirect()->back()->with('success', 'Notification deleted successfully');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        DB::table('notifications')->whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'Notification deleted successfully'
        ]);
    }
}
