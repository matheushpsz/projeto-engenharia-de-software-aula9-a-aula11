<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $table = 'genres';
    protected $fillable = ['name'];

    //função para criar o relacionamento com o modelo Movie
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(
            Movie::class, 
            'genres_movies', // tabela intermediária
            'genre_id', 
            'movie_id');
    }
}