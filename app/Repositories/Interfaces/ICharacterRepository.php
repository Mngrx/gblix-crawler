<?php

namespace App\Repositories\Interfaces;

use App\Models\Character;

interface ICharacterRepository {

    public function create($character);
    public function findAll();
    public function findById($id);
    public function delete($id);


}
