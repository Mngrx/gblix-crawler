<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ICharacterRepository;
use App\Models\Character;

class CharacterRepository extends GenericRepository implements ICharacterRepository{



    public function __construct(Character $model) {

        parent::__construct($model);

    }
}
