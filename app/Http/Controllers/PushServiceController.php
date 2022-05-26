<?php

namespace App\Http\Controllers;

use App\Services\Pushall;

class PushServiceController extends Controller
{
    public function form()
    {
        return view('service');
    }

    public function send(Pushall $pushall)
    {
        $data = \request()->validate([
            'name' => 'required|max:80',
            'text' => 'required|max:500'
        ]);

        $pushall->send($data['name'], $data['text']);

        return redirect('/service')->with('info', 'Сообщение отправленно');
    }
}
