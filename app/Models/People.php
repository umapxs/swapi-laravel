<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    /**
     * Relationships
     *
     */

    public function films()
    {
        return $this->belongsToMany(Film::class, 'people_starships_films', 'people_id', 'films_id');
    }

    public function starships()
    {
        return $this->belongsToMany(Starship::class, 'people_starships_films', 'people_id', 'starships_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
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

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()
            ->where('id', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('height', 'like', '%'.$search.'%')
            ->orWhere('mass', 'like', '%'.$search.'%')
            ->orWhere('hair_color', 'like', '%'.$search.'%')
            ->orWhere('skin_color', 'like', '%'.$search.'%')
            ->orWhere('eye_color', 'like', '%'.$search.'%')
            ->orWhere('birth_year', 'like', '%'.$search.'%')
            ->orWhere('gender', 'like', '%'.$search.'%');
            // ->orWhereRaw('lower(pilots) like ?', ['%'.strtolower($search).'%'])
            // ->orWhereRaw('lower(films) like ?', ['%'.strtolower($search).'%']);
    }
}
