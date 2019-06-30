<?php

namespace App\Repositories\Interfaces;

use App\Models\Movie;

interface IMovieRepository {

    public function create($movie);
    public function findAll();
    public function findById($id);
    public function delete($id);
    public function update(Movie $movie);

}
