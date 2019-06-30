<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'movies';

    protected $primaryKey = 'id_api';

    public $timestamps = true;

    protected $fillable = [
        'id_api',
        'name',
        'description',
        'director',
        'producer',
        'release_year',
        'score'
    ];

    // Relacionamento 'movie tem characters'
    public function characters()
    {
        return $this->hasMany(Character::class, 'movie_id_api', 'id_api');
    }

}
