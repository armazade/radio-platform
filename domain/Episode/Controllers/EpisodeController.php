<?php

namespace Domain\Episode\Controllers;

use App\Http\Controllers\Controller;
use Domain\Episode\Models\Episode;
use Inertia\Inertia;

class EpisodeController extends Controller
{
    public function index()
    {
        $episodes = Episode::all()->map(function ($episode) {
            return [
                'id' => $episode->id,
                'title' => $episode->title,
                'description' => $episode->description,
                'imageUrl' => $episode->getFirstMediaUrl('images'),
            ];
        });

        return Inertia::render('Guest/Home', [
            'episodes' => $episodes,
        ]);
    }

    public function show(Episode $episode)
    {
        return Inertia::render('Guest/Show', [
            'episode' => $episode,
            'imageUrl' => $episode->getFirstMediaUrl('images')
        ]);
    }
}
