<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    protected $table = 'movies';
    protected $fillable = [
        'title',
        'year',
        'duration',
        'genres'
    ];

    //função para criar o relacionamento com o modelo Genre
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(
            Genre::class, 
            'genres_movies', // tabela intermediária
            'movie_id', 
            'genre_id');
    }
}