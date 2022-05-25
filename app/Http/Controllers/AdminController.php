<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Notification;
use App\Models\Tiding;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function feedback()
    {
        $notifications = Notification::latest()->get();
        return view('admin.feedback', compact('notifications'));
    }

    public function articles()
    {
        $articles = Article::latest()->get();
        return view('admin.articles', compact('articles'));
    }

    public function tidings()
    {
        $tidings = Tiding::latest()->get();
        return view('admin.tidings', compact('tidings'));
    }
}
