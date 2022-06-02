<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Models\Role;
use App\Models\Tiding;
use App\Services\TagsSynchronizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Tests\Integration\Database\EloquentMorphToIsTest\Comment;

class TidingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        if (request()->getRequestUri() != '/') {
            Cache::tags(['tidings'])->flush();
        }

        $tidings = Tiding::getTidings();

        return view('tidings.index', ['tidings' => $tidings]);
    }

    public function show(Tiding $tiding)
    {
        $tiding = Tiding::getTiding($tiding);

        $comments = $tiding->commentTiding();

        if (!$tiding) abort(404);

        return view('tidings.show', compact('tiding', 'comments'));
    }

    public function create()
    {
        return view('tidings.create');
    }

    public function store(StoreArticle $request, TagsSynchronizer $tagsSynchronizer)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();

        $tiding = Tiding::create($attributes);
        if (!$tiding) abort(404);

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return $item;
        });

        $tagsSynchronizer->sync($tags, $tiding);

        return redirect('/tidings/')->with('info', 'Новость успешно создана');
    }

    public function edit(Tiding $tiding)
    {
        $tiding = Tiding::getTiding($tiding);
        if (!$tiding) abort(404);

        $this->authorize('update', $tiding);

        return view('tidings.edit', compact('tiding'));
    }

    public function update(Tiding $tiding, StoreArticle $request, TagsSynchronizer $tagsSynchronizer)
    {
        $tiding = Tiding::getTiding($tiding);
        if (!$tiding) abort(404);

        $attributes = $request->validated();
        $tiding->update($attributes);

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return $item;
        });

        $tagsSynchronizer->sync($tags, $tiding);

        Cache::tags('tiding' . $tiding->slug)->flush();

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
