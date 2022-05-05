<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function feedback()
    {
        $notifications = Notification::latest()->get();
        return view('admin.feedback', compact('notifications'));
    }
}
