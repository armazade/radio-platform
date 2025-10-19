<?php

namespace Domain\Episode\Controllers;

use App\Http\Controllers\Controller;
use Domain\Episode\Enums\Genre;
use Domain\Episode\Models\Episode;
use Inertia\Inertia;

class EpisodeController extends Controller
{
    public function index()
    {
        $episodes = Episode::all()->map(function ($episode) {
            $genres = $episode->getGenreEnums();

            return [
                'id' => $episode->id,
                'title' => $episode->title,
                'description' => $episode->description,
                'date' => $episode->date->format('d-m-Y'),
                'location' => $episode->location,
                'imageUrl' => $episode->getFirstMediaUrl('images'),
                'genres' => array_map(function ($genre) {
                    return [
                        'name' => $genre->value,
                        'value' => $genre->value,
                    ];
                }, $genres),
            ];
        });

        return Inertia::render('Guest/Home', [
            'episodes' => $episodes,
        ]);
    }

    public function show(Episode $episode)
    {
        $genres = $episode->getGenreEnums();

        return Inertia::render('Guest/Show', [
            'episode' => [
                'id' => $episode->id,
                'title' => $episode->title,
                'description' => $episode->description,
                'date' => $episode->date->format('d-m-Y'),
                'location' => $episode->location,
                'genres' => array_map(function ($genre) {
                    return [
                        'name' => $genre->value,
                        'value' => $genre->value,
                    ];
                }, $genres),
            ],
            'imageUrl' => $episode->getFirstMediaUrl('images')
        ]);
    }
}
