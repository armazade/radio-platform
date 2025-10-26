<?php

namespace Domain\Episode\Services;

use Domain\Episode\Enums\Genre;
use Domain\Episode\Models\Episode;
use Illuminate\Support\Collection;

class EpisodeService
{
    public static function index(?string $genre = null): Collection
    {
        $query = Episode::query()
            ->orderByDesc('date')
            ->orderByDesc('created_at');

        if ($genre && in_array($genre, Genre::values())) {
            $query->withGenre($genre);
        }

        return $query->get()->map(function ($episode) {
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
    }

    public static function getAvailableGenres(): array
    {
        return Genre::values();
    }
}
