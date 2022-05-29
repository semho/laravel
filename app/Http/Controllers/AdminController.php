<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Notification;
use App\Models\Role;
use App\Models\Tiding;
use Illuminate\Support\Facades\Auth;
use App\Jobs\TotalReport;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!Role::isAdmin(Auth::user())) {
            return redirect('/');
        }
        return view('admin.index');
    }

    public function feedback()
    {
        if (!Role::isAdmin(Auth::user())) {
            return redirect('/');
        }
        $notifications = Notification::select('*')->orderByDesc('id')->simplePaginate(20);
        return view('admin.feedback', compact('notifications'));
    }

    public function articles()
    {
        if (!Role::isAdmin(Auth::user())) {
            return redirect('/');
        }
        $articles = Article::select('*')->orderByDesc('id')->simplePaginate(20);
        return view('admin.articles', compact('articles'));
    }

    public function tidings()
    {
        if (!Role::isAdmin(Auth::user())) {
            return redirect('/');
        }
        $tidings = Tiding::select('*')->orderByDesc('id')->simplePaginate(20);
        return view('admin.tidings', compact('tidings'));
    }

    public function reports()
    {
        if (!Role::isAdmin(Auth::user())) {
            return redirect('/');
        }
        return view('admin.reports');
    }

    public function total()
    {
        if (!Role::isAdmin(Auth::user())) {
            return redirect('/');
        }
        return view('admin.reports_total');
    }

    public function totalSend()
    {
        if (!Role::isAdmin(Auth::user())) {
            return redirect('/');
        }

        $attributes = request()->toArray();
        array_shift($attributes);

        if (empty($attributes)) {
            return redirect('admin/reports_total')->with('status', 'Для отправки отчета следует выбрать пункт!');
        }

        TotalReport::dispatchSync(Auth::user(), $attributes);

        return redirect('admin/reports')->with('info', 'Отчет отправлен на email');
    }
}
