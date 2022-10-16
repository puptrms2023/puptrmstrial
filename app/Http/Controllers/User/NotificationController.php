<?php

namespace App\Http\Controllers\User;

use App\Models\User;
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
        return view('user.all-notifications.index');
    }
    public function showAA($id)
    {
        $status = StudentApplicant::where('user_id', Auth::id())->get();
        $getid = DB::table('notifications')->where('id', $id)->pluck('id');
        DB::table('notifications')->where('id', $getid)->update(['read_at' => now()]);

        return view('user.application-status.academic-award', compact('status'));
    }
    public function showAE($id)
    {
        $status = AcademicExcellence::where('user_id', Auth::id())->get();
        $getid = DB::table('notifications')->where('id', $id)->pluck('id');
        DB::table('notifications')->where('id', $getid)->update(['read_at' => now()]);

        return view('user.application-status.academic-excellence', compact('status'));
    }
    public function showNA($id)
    {
        $status = NonAcademicApplicant::where('user_id', Auth::id())->get();
        $getid = DB::table('notifications')->where('id', $id)->pluck('id');
        DB::table('notifications')->where('id', $getid)->update(['read_at' => now()]);

        return view('user.application-status.non-academic-award', compact('status'));
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
