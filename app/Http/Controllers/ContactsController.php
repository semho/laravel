<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function store()
    {
        $this->validate(request(), [
            'email' => 'required|email:rfc,dns',
            'message' => 'required',
        ]);

        $notification = new Notification();

        $notification->email = request('email');
        $notification->message = request('message');

        $notification->save();

        return redirect('/');
    }
}
