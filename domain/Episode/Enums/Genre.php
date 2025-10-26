<?php

namespace Domain\Episode\Enums;

enum Genre: string
{
    case AMBIENT = 'Ambient';
    case AFROBEAT = 'Afrobeat';
    case BREAKBEAT = 'Breakbeat';
    case CLASSICAL = 'Classical';
    case DISCO = 'Disco';
    case DRUM_AND_BASS = 'Drum & Bass';
    case DUBSTEP = 'Dubstep';
    case DUB = 'Dub';
    case ELECTRONIC = 'Electronic';
    case EXPERIMENTAL = 'Experimental';
    case FUNK = 'Funk';
    case FOLK = 'Folk';
    case GARAGE = 'Garage';
    case GRIME = 'Grime';
    case HIP_HOP = 'Hip Hop';
    case HOUSE = 'House';
    case IDM = 'IDM';
    case INDIE = 'Indie';
    case JAZZ = 'Jazz';
    case JUNGLE = 'Jungle';
    case LATIN = 'Latin';
    case ORIENTAL = 'Oriental';
    case REGGAE = 'Reggae';
    case ROCK = 'Rock';
    case RNB = 'R&B';
    case SOUL = 'Soul';
    case TALK = 'Talk';
    case TECHNO = 'Techno';
    case TRADITIONAL = 'Traditional';
    case WORLD = 'World';

    /**
     * Get all genre values as an array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
