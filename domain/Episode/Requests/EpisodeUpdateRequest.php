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
            'audio' => ['nullable', 'file', 'max:512000'],
        ];
    }

    public function messages(): array
    {
        return [
            'audio.mimes' => 'The audio file must be an MP3, WAV, OGG, or M4A file.',
            'audio.max' => 'The audio file must not be larger than 50MB.',
        ];
    }
}
