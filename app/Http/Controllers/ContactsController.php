<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email:rfc,dns',
            'message' => 'required',
        ]);

        Notification::create($attributes);

        return redirect('/');
    }
}
