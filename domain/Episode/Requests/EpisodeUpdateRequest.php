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
            'image'       => ['nullable', 'image', 'max:500000'],
        ];
    }
}
