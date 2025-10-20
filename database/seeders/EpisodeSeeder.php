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
            'title' => 'Rene Matic',
            'description' => 'Smooth ambient and downtempo for late night listening.',
            'date' => now(),
        ]);
        $episode1->setGenres([Genre::AMBIENT, Genre::EXPERIMENTAL]);
        $episode1->save();

        $episode2 = Episode::create([
            'title' => 'Discostan',
            'description' => 'Fast-paced jungle and drum & bass session.',
            'date' => now()->subDays(1),
        ]);
        $episode2->setGenres([Genre::JUNGLE, Genre::DRUM_AND_BASS]);
        $episode2->save();

        $episode3 = Episode::create([
            'title' => 'Techy techno',
            'description' => 'Dark and hypnotic techno sounds.',
            'date' => now()->subDays(1),
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

        $episode7 = Episode::create([
            'title' => 'Tehrangeles',
            'description' => 'A fusion of Persian traditional music with modern electronic beats.',
            'date' => now()->subDays(9),
        ]);
        $episode7->setGenres([Genre::TRADITIONAL, Genre::EXPERIMENTAL, Genre::ORIENTAL]);
        $episode7->save();

        $episode8 = Episode::create([
            'title' => 'Rupture w/ Mantra',
            'description' => 'Sounds from the grass roots of jungle and drum & bass with London scene heroes Rupture ',
            'date' => now()->subDays(9),
        ]);
        $episode8->setGenres([Genre::DRUM_AND_BASS, Genre::JUNGLE, Genre::AMBIENT]);
        $episode8->save();

        $episode9 = Episode::create([
            'title' => 'Lu Yang',
            'description' => 'Buddhist traditional music fused with contemporary electronic sounds by Chinese artist Lu Yang.',
            'date' => now()->subDays(9),
        ]);
        $episode9->setGenres([Genre::ORIENTAL, Genre::WORLD, Genre::AMBIENT]);
        $episode9->save();
    }
}
