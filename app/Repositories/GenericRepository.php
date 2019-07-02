<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class GenericRepository {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function create($data) {
        if (!isset($data)) {
            return null;
        }

        return $this->model->create($data);
    }

    public function insert($data)
    {
        if (!isset($data)) {
            return null;
        }

        return $this->model->insert($data);
    }

    public function findAll($params = ['*']) {
        return $this->model->all($params);
    }

    public function findById($id) {

        if (!isset($id)) {
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
}
