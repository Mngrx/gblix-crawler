<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IMovieRepository;
use App\Models\Movie;
use App\Facades\MovieRepository as Repository;


class MovieRepository extends GenericRepository implements IMovieRepository {

    public function __construct() {
        $model = new Movie();
        parent::__construct($model);
    }

    public function saveMassive($films) {

        $moviesToSave = [];
        foreach ($films as $film) {

            $movie = $this->findById($film->id);

            if (!empty($movie)) {

                //Atualizando os registros já existentes com os dados mais novos.
                //Pode ter custo computacional alto, mas compensa pela atualidade dos dados.
                //Além do Laravel ter inteligencia para não fazer updates desnecessários, caso
                //nenhuma informação tenha sido modificada.
                $movie->id_api = $film->id;
                $movie->title = $film->title;
                $movie->description = $film->description;
                $movie->director = $film->director;
                $movie->producer = $film->producer;
                $movie->release_year = $film->release_date;
                $movie->score = $film->rt_score;

                $movie->save();

            } else {

                $moviesToSave[] = [
                    'id_api' => $film->id,
                    'title' => $film->title,
                    'description' => $film->description,
                    'director' => $film->director,
                    'producer' => $film->producer,
                    'release_year' => $film->release_date,
                    'score' => $film->rt_score,
                    'created_at' => date("Y-m-d H:i:s")
                ];

            }
        }

        //Salvando os filmes que foram requisitados
        Repository::insert($moviesToSave);
    }

}
