<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class GenericRepository {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function create($data) {
        if (isset($data)) {
            return null;
        }

        return $this->model->create($data);
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

      $data = $this->model::find($id);

      if (!$data) {
        return null;
      }

      $data->delete();

      return $data;

    }

    public function update(Model $data) {

        $data->save();

        return $data->toArray();
    }

}
