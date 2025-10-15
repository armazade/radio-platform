<?php

namespace Database\Seeders;

use Domain\Episode\Enums\Genre;
use Domain\Episode\Models\Episode;
use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    public function run(): void
    {
        $episode1 = Episode::create([
            'title' => 'Late Night Vibes',
            'description' => 'Smooth ambient and downtempo for late night listening.',
            'date' => now(),
        ]);
        $episode1->setGenres([Genre::AMBIENT, Genre::EXPERIMENTAL]);
        $episode1->save();

        $episode2 = Episode::create([
            'title' => 'Jungle Fever',
            'description' => 'Fast-paced jungle and drum & bass session.',
            'date' => now()->subDays(1),
        ]);
        $episode2->setGenres([Genre::JUNGLE, Genre::DRUM_AND_BASS]);
        $episode2->save();

        $episode3 = Episode::create([
            'title' => 'Underground Techno',
            'description' => 'Dark and hypnotic techno sounds.',
            'date' => now()->subDays(2),
        ]);
        $episode3->setGenres([Genre::TECHNO, Genre::HOUSE]);
        $episode3->save();

        $episode4 = Episode::create([
            'title' => 'Jamaican Roots',
            'description' => 'Dark and hypnotic techno sounds.',
            'date' => now()->subDays(3),
        ]);
        $episode4->setGenres([Genre::DUB, Genre::AFROBEAT]);
        $episode4->save();

        $episode5 = Episode::create([
            'title' => 'Trap music',
            'description' => 'Dark and hypnotic techno sounds.',
            'date' => now()->subDays(4),
        ]);
        $episode5->setGenres([Genre::HIP_HOP, Genre::EXPERIMENTAL]);
        $episode5->save();

        $episode6 = Episode::create([
            'title' => 'Breakfast Show',
            'description' => 'Dark and hypnotic techno sounds.',
            'date' => now()->subDays(7),
        ]);
        $episode6->setGenres([Genre::JAZZ, Genre::HOUSE]);
        $episode6->save();

    }
}
