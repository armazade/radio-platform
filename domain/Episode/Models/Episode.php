<?php

namespace Domain\Episode\Models;

use Domain\Episode\Enums\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Episode extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'genres',
    ];

    protected $casts = [
        'date' => 'date',
        'genres' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);
    }

    /**
     * Get genres as Genre enum instances
     *
     * @return array<Genre>
     */
    public function getGenreEnums(): array
    {
        if (!$this->genres) {
            return [];
        }

        return array_map(
            fn($genre) => Genre::from($genre),
            $this->genres
        );
    }

    /**
     * Set genres from Genre enum instances
     *
     * @param array<Genre> $genres
     */
    public function setGenres(array $genres): void
    {
        $this->genres = array_map(
            fn($genre) => $genre->value,
            $genres
        );
    }

    /**
     * Scope to filter by genre
     */
    public function scopeWithGenre($query, Genre|string $genre)
    {
        $genreValue = $genre instanceof Genre ? $genre->value : $genre;

        return $query->whereJsonContains('genres', $genreValue);
    }
}
