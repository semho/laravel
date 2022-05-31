<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Role;
use App\Models\Tag;
use App\Models\Tiding;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Jobs\TotalReport;

class AdminController extends Controller
{
    public $data = [];

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
        //читаем файл в строку полученный из данных тела запроса
        $json = file_get_contents('php://input');
        //декодируем данные json в переменную php
        $dataJson = json_decode($json, true);
        $dataNew = [];
        foreach ($dataJson as $key => $item) {
            if ($item) {
                $dataNew[$key] = $item;
            }
        }

        //если ничего не выбрано
        if (empty($dataNew)) {
            $this->data['message'] = 'Для отправки отчета следует выбрать пункт!';
        //иначе
        } else {
            $this->data['success'] = true;
            isset($dataNew['news']) ? $dataNew['news'] = "Новостей: " . Tiding::count() : "";
            isset($dataNew['articles']) ? $dataNew['articles'] = "Статей: " . Article::count() : "";
            isset($dataNew['comments']) ? $dataNew['comments'] = "Комментарий: " . Comment::count() : "";
            isset($dataNew['tags']) ? $dataNew['tags']= "Тегов: " . Tag::count() : "";
            isset($dataNew['users']) ? $dataNew['users'] = "Пользователей: " . User::count() : "";
            $this->data['result'] = $dataNew;

            TotalReport::dispatchSync(Auth::user(), $dataNew);
            event(new \App\Events\ReportGenerated($dataNew, auth()->user()));
        }

        //отправляем ответ в виде json
        return json_encode($this->data);
    }

}
