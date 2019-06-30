<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IMovieRepository;
use App\Models\Movie;

class MovieRepository implements IMovieRepository {

    private $model;

    public function __construct(Movie $model) {
        $this->model = $model;
    }

    public function create($movie) {
        if (isset($movie)) {
            return null;
        }


        return $this->model->create($movie);

    }

    public function findAll() {
        return $this->model->all();
    }

    public function findById($id) {

        if (isset($id)) {
            return null;
        }

        return $this->model::find($id);
    }

    public function delete($id) {

      $movie = $this->model::find($id);

      if (!$movie) {
        return null;
      }

      $movie->delete();

      return $movie;

    }

    public function update(Movie $movie) {

        $movie->save();

        return $movie->toArray();
    }








}
