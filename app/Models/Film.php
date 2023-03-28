<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public function starships()
    {
        return $this->belongsToMany(Starship::class, 'people_starships_films', 'films_id', 'starships_id');
    }

    public function characters()
    {
        return $this->belongsToMany(People::class, 'people_starships_films', 'films_id', 'people_id');
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
}
