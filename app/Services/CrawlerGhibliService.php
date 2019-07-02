<?php

namespace App\Services;

use App\Facades\CharacterRepository;
use App\Facades\MovieRepository;

class CrawlerGhibliService {

    private $characterRepository;
    private $movieRepository;
    private $apiBaseUrl = 'https://ghibliapi.herokuapp.com/';

    public function __construct() {

    }

    public function doCrawl() {

        //Requisitando informações dos filmes
        $films = httpGET($this->apiBaseUrl . 'films', ['limit' => '250']);

        //Criando array com os nome dos atributos usados no banco para os filmes
        MovieRepository::saveMassive($films);

        //Requisitando informações das pessoas
        $people = httpGET($this->apiBaseUrl . 'people', ['limit' => '250']);

        //Criando array com os nome dos atributos usados no banco para os personagens
        CharacterRepository::saveMassive($people);

    }
}


?>
