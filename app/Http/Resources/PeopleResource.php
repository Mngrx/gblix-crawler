<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    /*
        Nome do Personagem
        Idade do Personagem
        Título do Filme
        Ano de Lançamento do Filme
        Pontuação Rotten Tomato
    */

        return [
            'nome_personagem' => $this->name,
            'idade_personagem' => $this->age,
            'titulo_filme' => $this->movie->title,
            'ano_lancamento' => $this->movie->release_year,
            'pontuacao_filme' => $this->movie->score
        ];
    }
}
