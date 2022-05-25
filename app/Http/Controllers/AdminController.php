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
        $notifications = Notification::select('*')->orderByDesc('id')->simplePaginate(20);
        return view('admin.feedback', compact('notifications'));
    }

    public function articles()
    {
        $articles = Article::select('*')->orderByDesc('id')->simplePaginate(20);
        return view('admin.articles', compact('articles'));
    }

    public function tidings()
    {
        $tidings = Tiding::select('*')->orderByDesc('id')->simplePaginate(20);
        return view('admin.tidings', compact('tidings'));
    }
}
