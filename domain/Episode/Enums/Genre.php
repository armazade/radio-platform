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
    case TRADITIONAL = 'Traditional';
    case ORIENTAL = 'Oriental';

    /**
     * Get all genre values as an array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
