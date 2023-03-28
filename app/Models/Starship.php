<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Starship extends Model
{
    use HasFactory;

    public function films()
    {
        return $this->belongsToMany(Film::class, 'people_starships_films', 'starships_id', 'films_id');
    }

    public function pilots()
    {
        return $this->belongsToMany(People::class, 'people_starships_films', 'starships_id', 'people_id');
    }

    protected $fillable = [
        'id',
        'name',
        'model',
        'manufactorer',
        'cost_in_credits',
        'length',
        'max_atmosphering_speed',
        'crew',
        'passengers',
        'cargo_capacity',
        'consumables',
        'hyperdrive_rating',
        'MGLT',
        'starship_class',
        'pilots',
        'films',
        'created',
        'edited',
        'url'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()->where('id', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('model', 'like', '%'.$search.'%');
    }
}
