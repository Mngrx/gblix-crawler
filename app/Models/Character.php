<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'characters';

    protected $primaryKey = 'id_api';

    // Para fazer o Eloquent enteder que o 'id_api' é uma string
    protected $casts = [
        'id_api' => 'string'
    ];

    public $timestamps = true;

    protected $fillable = [
        'id_api',
        'name',
        'gender',
        'age',
        'eye_color',
        'hair_color',
        'movie_id_api'
    ];

    // Relacionamento 'character tem movie'
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id_api', 'id_api');
    }
}
