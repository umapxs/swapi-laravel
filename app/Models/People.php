<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    public function films()
    {
        return $this->belongsToMany(Film::class, 'people_starships_films', 'people_id', 'films_id');
    }

    public function starships()
    {
        return $this->belongsToMany(Starship::class, 'people_starships_films', 'people_id', 'starships_id');
    }

    protected $fillable = [
        'id',
        'height',
        'mass',
        'hair_color',
        'skin_color',
        'eye_color',
        'birth_year',
        'gender',
        'homeworld',
        'films',
        'species',
        'vehicles',
        'starships',
        'created',
        'edited',
        'url'
    ];
}
