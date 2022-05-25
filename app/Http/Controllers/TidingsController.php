<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Models\Role;
use App\Models\Tiding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TidingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        if (Auth::check() && Role::isAdmin(auth()->user())) {
            $tidings = Tiding::select('*');
        } elseif (Auth::check()) {
            $tidings = Tiding::publishedAndUser();
        } else {
            $tidings = Tiding::published();
        }

        return view('tidings.index', ['tidings' => $tidings->orderByDesc('id')->simplePaginate(10)]);
    }

    public function show(Tiding $tiding)
    {
        $tiding = Tiding::getTiding($tiding);

        if (!$tiding) abort(404);

        return view('tidings.show', compact('tiding'));
    }

    public function create()
    {
        return view('tidings.create');
    }

    public function store(StoreArticle $request)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();

        $tiding = Tiding::create($attributes);
        if (!$tiding) abort(404);

        return redirect('/tidings/')->with('info', 'Новость успешно создана');
    }

    public function edit(Tiding $tiding)
    {
        $tiding = Tiding::getTiding($tiding);
        if (!$tiding) abort(404);

        $this->authorize('update', $tiding);

        return view('tidings.edit', compact('tiding'));
    }

    public function update(Tiding $tiding, StoreArticle $request)
    {
        $tiding = Tiding::getTiding($tiding);
        if (!$tiding) abort(404);

        $attributes = $request->validated();
        $tiding->update($attributes);

        return redirect('/tidings/')->with('info', 'Новость успешно обновлена');
    }

    public function destroy(Tiding $tiding)
    {
        $tiding = Tiding::getTiding($tiding);
        if (!$tiding) abort(404);

        $this->authorize('delete', $tiding);

        $tiding->delete();

        return redirect('/tidings/')->with('info', 'Новость удалена');
    }
}
