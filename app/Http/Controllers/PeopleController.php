<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PeopleResource;
use App\Models\Character;

class PeopleController extends Controller
{
    /*

        Usando as informações disponíveis no banco de dados DEVE-SE criar uma rota GET /pessoas que:

        DEVE retornar as seguintes colunas
            Nome do Personagem
            Idade do Personagem
            Título do Filme
            Ano de Lançamento do Filme
            Pontuação Rotten Tomato
        DEVE retornar os resultados baseado no parâmetro fmt
            html: Uma página HTML com a tabela
            json: Estrutura JSON do resultado
            csv: Um arquivo no formato CSV separado com ponto e vírgula (;)
        PODERÁ filtrar a informação de alguma coluna usando o parâmetro filter
        PODERÁ alterar ordenação de alguma coluna usando o parâmetro order
        PODERÁ altere a sequência da ordenação usando o parâmetro sort

    */

    // Rota 'GET /pessoas' vai acessar aqui
    public function index(Request $request)
    {

        // Pega o formato de retorno
        $format = $request['fmt'];

        // Se não for passado um formato na requisição, o padrão será 'json'
        if ($format != 'json' && $format != 'html' && $format != 'csv') {
            $format = 'json';
        }

        $data = Character::all();

        if ($format == 'json') {
            // Usando resource para padronizar a exposição de dados
            return response(PeopleResource::collection($data))->header('Content-Type', 'application/json');
        } elseif ($format == 'csv') {

        } elseif ($format == 'html') {

        }

    }
}
