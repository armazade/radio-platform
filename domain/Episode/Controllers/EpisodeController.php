<?php

namespace Domain\Episode\Controllers;

use App\Http\Controllers\Controller;
use Domain\Episode\Enums\Genre;
use Domain\Episode\Models\Episode;
use Domain\Episode\Services\EpisodeService;
use Inertia\Inertia;

class EpisodeController extends Controller
{
    public function index(?string $genre = null)
    {
        // Validate genre if provided
        if ($genre && !in_array($genre, Genre::values())) {
            abort(404, 'Genre not found');
        }

        $episodes = EpisodeService::index($genre);

        return Inertia::render('Guest/Home', [
            'episodes' => $episodes,
            'allGenres' => EpisodeService::getAvailableGenres(),
            'selectedGenre' => $genre,
        ]);
    }

    public function show(Episode $episode)
    {
        $genres = $episode->getGenreEnums();

        return Inertia::render('Guest/Episode/Show', [
            'episode' => [
                'id' => $episode->id,
                'title' => $episode->title,
                'description' => $episode->description,
                'date' => $episode->date->format('d-m-Y'),
                'location' => $episode->location,
                'audioUrl' => $episode->getFirstMediaUrl('audio'),
                'hasAudio' => $episode->hasAudio(),
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
