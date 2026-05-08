<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $loans = Loam::all();

        $notifications = Notification::latest()->paginate(10);

        return view('notifications.index', compact('notifications', 'loans'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        $notification->update([
            'is_read' => true
        ]);

        return back()->with('success', 'Notification marked as read.');
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        $notification->delete();

        return back()->with('success', 'Notification deleted.');
    }
}
