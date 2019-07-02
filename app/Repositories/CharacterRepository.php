<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ICharacterRepository;
use App\Models\Character;

class CharacterRepository extends GenericRepository implements ICharacterRepository{


    public function __construct() {

        $model = new Character();

        parent::__construct($model);

    }


    public function saveMassive($people) {

        $charactersToSave = [];

        foreach ($people as $person) {

            $idMovie = explode('/', $person->films[0]);
            $idMovie = end($idMovie);

            $character = $this->findById($person->id);

            if (!empty($character)) {

                //Atualizando os registros já existentes com os dados mais novos.
                //Pode ter custo computacional alto, mas compensa pela atualidade dos dados.
                //Além do Laravel ter inteligencia para não fazer updates desnecessários, caso
                //nenhuma informação tenha sido modificada.

                $character->id_api = $person->id;
                $character->name = $person->name;
                $character->gender = $person->gender;
                $character->age = $person->age;
                $character->eye_color = $person->eye_color;
                $character->hair_color = $person->hair_color;
                $character->movie_id_api = $idMovie;

                $character->save();

            } else {
                $charactersToSave[] = [
                    'id_api' => $person->id,
                    'name' => $person->name,
                    'gender' => $person->gender,
                    'age' => $person->age,
                    'eye_color' => $person->eye_color,
                    'hair_color' => $person->hair_color,
                    'movie_id_api' => $idMovie,
                    'created_at' => date("Y-m-d H:i:s")
                ];
            }
        }
        //Salvando as pessoas novas que foram requisitadas
        Character::insert($charactersToSave);
    }

    public function getDataWithParams($order, $sort, $filters) {
        // Motando a query do Eloquent na tabela Characters
        $query = Character::query();
        $query->join('movies', 'movies.id_api', '=', 'characters.movie_id_api');

        if ($order) {
            $query->orderBy($order, $sort);
        }

        $numFilters = count($filters);
        $keys = array_keys($filters);
        // Adiciona os filtros
        for ($i = 0; $i < $numFilters; $i++) {
            foreach ($filters[$keys[$i]] as $value) {
                $query->orWhere($keys[$i], '=', $value);
            }
        }

        return $query->get();
    }

}
