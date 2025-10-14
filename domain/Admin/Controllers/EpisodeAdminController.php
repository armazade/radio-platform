<?php

namespace Domain\Admin\Controllers;

use App\Http\Controllers\Controller;
use Domain\Episode\Models\Episode;
use Domain\Episode\Requests\EpisodeUpdateRequest;
use Inertia\Inertia;

class EpisodeAdminController extends Controller
{
    public function index()
    {
        $episodes = Episode::all();
        return Inertia::render('Admin/Episode/Index', [
            'episodes' => $episodes,
            'flash' => [
                'success' => session('success'),]
        ]);
    }

    public function create()
        {
        return Inertia::render('Admin/Episode/Create');
        }

    public function store(EpisodeUpdateRequest $request)
    {
        $validated = $request->validated();

        $episode = Episode::create($validated);

        if ($request->hasFile('image')) {
            $episode
                ->addMediaFromRequest('image')
                ->toMediaCollection('images', 'public');
        }

        return redirect()
            ->route('admin.episodes.index')
            ->with('success', 'Episode created!');
    }

    public function show(Episode $episode)
    {
        return Inertia::render('Admin/Episode/Show', [
            'episode' => $episode,
            'imageUrl' => $episode->getFirstMediaUrl('images'),
        ]);
    }

    public function update(EpisodeUpdateRequest $request, Episode $episode)
    {
        $validated = $request->validated();

        $episode->update(attributes: $validated);

        if ($request->hasFile('image')) {
            $episode->clearMediaCollection('images');
            $episode->addMediaConversion('thumb')->toMediaCollection('images');
        }

        return redirect()->route('admin.episodes.index')->with('success', 'Episode updated successfully.');
    }
}
