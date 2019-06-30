<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;
use App\Models\Character;

class ApiCrawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get informantion on Studio Ghibli API and persist it in our database. :)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $apiBaseUrl = 'https://ghibliapi.herokuapp.com/';


        //Requisitando informações dos filmes
        $films = httpGET($apiBaseUrl . 'films', ['limit' => '250']);

        //Criando array com os nome dos atributos usados no banco para os filmes
        $moviesToSave = [];
        foreach ($films as $film) {

            $movie = Movie::find($film->id);

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
        Movie::insert($moviesToSave);

        //Requisitando informações das pessoas
        $people = httpGET($apiBaseUrl . 'people', ['limit' => '250']);

        //Criando array com os nome dos atributos usados no banco para os personagens
        $charactersToSave = [];
        foreach ($people as $person) {

            $idMovie = explode('/', $person->films[0]);
            $idMovie = end($idMovie);

            $character = Character::find($person->id);

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

        $this->comment('Got data successfully!');
    }
}
