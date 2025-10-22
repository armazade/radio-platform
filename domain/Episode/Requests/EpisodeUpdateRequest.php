<?php

namespace Domain\Episode\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'genres' => ['required', 'array'],
            'genres.*' => ['string'],
            'image'=> ['nullable', 'file', 'max:500000'],
            'audio' => ['nullable', 'file', 'mimes:mp3,wav,ogg,m4a', 'max:5120000'],
        ];
    }

    public function messages(): array
    {
        return [
            'audio.mimes' => 'The audio file must be an MP3, WAV, OGG, or M4A file.',
            'audio.max' => 'The audio file must not be larger than 500MB.',
            'date'        => ['required', 'date'],
            'location'    => ['nullable', 'string', 'max:255'],
            'genres'      => ['required', 'array'],
            'genres.*'    => ['string', 'in:Ambient,Jungle,Techno,House,Drum & Bass,Breakbeat,Dubstep,Garage,Grime,Experimental,Jazz,Funk,Soul,Disco,Hip Hop,R&B,Afrobeat,Latin,Reggae,Dub,Electronic,IDM,Indie,Rock,Folk,Classical,World,Talk,Experimental,Classical,Oriental,Traditional'],
            'image'       => ['nullable', 'image', 'max:500000'],
        ];
    }
}
