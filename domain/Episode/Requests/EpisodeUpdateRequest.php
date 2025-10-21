<?php

namespace Domain\Episode\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Adjust if you want to restrict to certain users later
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date'        => ['required', 'date'],
            'genres'      => ['required', 'array'],
            'genres.*'    => ['string', 'in:Ambient,Jungle,Techno,House,Drum & Bass,Breakbeat,Dubstep,Garage,Grime,Experimental,Jazz,Funk,Soul,Disco,Hip Hop,R&B,Afrobeat,Latin,Reggae,Dub,Electronic,IDM,Indie,Rock,Folk,Classical,World,Talk,Experimental,Classical,Oriental,Traditional'],
            'image'       => ['nullable', 'image', 'max:500000'],
        ];
    }
}
