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
        $episodes = Episode::all()->map(function ($episode) {
            return [
                'id' => $episode->id,
                'title' => $episode->title,
                'description' => $episode->description,
                'date' => $episode->date->format('d-m-Y'),
                'location' => $episode->location,
                'imageUrl' => $episode->getFirstMediaUrl('images'),
                'hasAudio' => $episode->hasAudio(),
            ];
        });

        return Inertia::render('Admin/Episode/Index', [
            'episodes' => $episodes,
            'flash' => [
                'success' => session('success'),
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Episode/Create');
    }

    public function store(EpisodeUpdateRequest $request)
    {
        $validated = $request->validated();

        // Ensure genres is an array
        if (!is_array($validated['genres'])) {
            $validated['genres'] = json_decode($validated['genres'], true) ?? [];
        }

        $episode = Episode::create($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $episode
                ->addMediaFromRequest('image')
                ->toMediaCollection('images', 'public');
        }

        // Handle audio upload
        if ($request->hasFile('audio')) {
            $episode
                ->addMediaFromRequest('audio')
                ->toMediaCollection('audio', 'public');
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
            'audioUrl' => $episode->getAudioUrl(),
            'audioMetadata' => $episode->getAudioMetadata(),
        ]);
    }

    public function edit(Episode $episode)
    {
        return Inertia::render('Admin/Episode/Edit', [
            'episode' => [
                'id' => $episode->id,
                'title' => $episode->title,
                'description' => $episode->description,
                'date' => $episode->date,
                'location' => $episode->location,
                'genres' => $episode->genres,
                'image' => $episode->getFirstMediaUrl('images'),
                'audio' => $episode->getAudioUrl(),
                'audioMetadata' => $episode->getAudioMetadata(),
            ],
        ]);
    }

    public function update(EpisodeUpdateRequest $request, Episode $episode)
    {
        $validated = $request->validated();

        if (!is_array($validated['genres'])) {
            $validated['genres'] = json_decode($validated['genres'], true) ?? [];
        }

        $episode->update($validated);

        if ($request->hasFile('image')) {
            $episode->clearMediaCollection('images');
            $episode->addMediaFromRequest('image')
                ->toMediaCollection('images', 'public');
        }

        // ✅ Add audio handling
        if ($request->hasFile('audio')) {
            $episode->clearMediaCollection('audio');
            $episode->addMediaFromRequest('audio')
                ->toMediaCollection('audio', 'public');
        }

        return redirect()
            ->route('admin.episodes.index')
            ->with('success', 'Episode updated successfully!');
    }

    public function destroy(Episode $episode)
    {
        $episode->delete();

        return redirect()
            ->route('admin.episodes.index')
            ->with('success', 'Episode deleted successfully!');
    }
}
