<?php

namespace Domain\Episode\Enums;

enum Genre: string
{
    case AMBIENT = 'Ambient';
    case JUNGLE = 'Jungle';
    case TECHNO = 'Techno';
    case HOUSE = 'House';
    case DRUM_AND_BASS = 'Drum & Bass';
    case BREAKBEAT = 'Breakbeat';
    case DUBSTEP = 'Dubstep';
    case GARAGE = 'Garage';
    case GRIME = 'Grime';
    case EXPERIMENTAL = 'Experimental';
    case JAZZ = 'Jazz';
    case FUNK = 'Funk';
    case SOUL = 'Soul';
    case DISCO = 'Disco';
    case HIP_HOP = 'Hip Hop';
    case RNB = 'R&B';
    case AFROBEAT = 'Afrobeat';
    case LATIN = 'Latin';
    case REGGAE = 'Reggae';
    case DUB = 'Dub';
    case ELECTRONIC = 'Electronic';
    case IDM = 'IDM';
    case INDIE = 'Indie';
    case ROCK = 'Rock';
    case FOLK = 'Folk';
    case CLASSICAL = 'Classical';
    case WORLD = 'World';
    case TALK = 'Talk';

    /**
     * Get all genre values as an array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get color for badge display
     */
    public function color(): string
    {
        return match($this) {
            self::AMBIENT, self::EXPERIMENTAL => 'bg-purple-100 text-purple-800',
            self::JUNGLE, self::DRUM_AND_BASS => 'bg-green-100 text-green-800',
            self::TECHNO, self::HOUSE => 'bg-blue-100 text-blue-800',
            self::JAZZ, self::SOUL, self::FUNK => 'bg-yellow-100 text-yellow-800',
            self::HIP_HOP, self::RNB => 'bg-red-100 text-red-800',
            self::AFROBEAT, self::LATIN => 'bg-orange-100 text-orange-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
