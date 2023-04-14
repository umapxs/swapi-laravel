<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    /**
     * Relationships
     *
     */

    public function starships()
    {
        return $this->belongsToMany(Starship::class, 'people_starships_films', 'films_id', 'starships_id');
    }

    public function characters()
    {
        return $this->belongsToMany(People::class, 'people_starships_films', 'films_id', 'people_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected $fillable = [
        'id',
        'title',
        'episode_id',
        'opening_crawl',
        'director',
        'producer',
        'release_date',
        'characters',
        'planets',
        'starships',
        'vehicles',
        'species',
        'created',
        'edited',
        'url'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()
            ->where('id', 'like', '%'.$search.'%')
            ->orWhere('title', 'like', '%'.$search.'%')
            ->orWhere('episode_id', 'like', '%'.$search.'%')
            ->orWhere('director', 'like', '%'.$search.'%')
            ->orWhere('producer', 'like', '%'.$search.'%')
            ->orWhere('release_date', 'like', '%'.$search.'%');
    }
}
