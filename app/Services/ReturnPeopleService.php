<?php

namespace App\Services;

use App\Facades\CharacterRepository;
use App\Http\Resources\PeopleResource;
use Illuminate\Http\Request;

class ReturnPeopleService
{

    public function returnData($request)
    {
        // Campos equivalentes entre as tabelas e os dados de retorno
        $fields = [
            'nome_personagem' => 'characters.name',
            'idade_personagem' => 'characters.age',
            'titulo_filme' => 'movies.title',
            'ano_lancamento' => 'movies.release_year',
            'pontuacao_filme' => 'movies.score'
        ];

        // Pega o formato de retorno
        $format = $request['fmt'];

        // Se não for passado um formato na requisição, o padrão será 'json'
        if ($format != 'json' && $format != 'html' && $format != 'csv') {
            $format = 'json';
        }

        // Pega a sequência de ordenação
        $sort = $request['sort'];

        // O padrão será 'asc'
        if ($sort != 'asc' && $sort != 'desc') {
            $sort = 'asc';
        }

        // Pega a coluna a ser ordenada
        $order = $request['order'];

        if (
            $order != 'nome_personagem' && $order != 'idade_personagem'
            && $order != 'titulo_filme' && $order != 'ano_lancamento'
            && $order != 'pontuacao_filme'
        ) {
            $order = null;
        } else {
            $order = $fields[$order];
        }

        // Lista para caso tenha filtros
        $filters = [];

        // As chaves que representam os filtros
        $fieldsKeys = array_keys($fields);
        // Número de chaves (pode expandir)
        $numKeys = count($fieldsKeys);

        for ($i = 0; $i < $numKeys; $i++) {

            if ($request[$fieldsKeys[$i]]) {
                $filters[$fields[$fieldsKeys[$i]]] = explode(',', $request[$fieldsKeys[$i]]);
            }
        }

        $data = CharacterRepository::getDataWithParams($order, $sort, $filters);

        if ($format == 'json') {
            return $this->returnJson($data);
        } elseif ($format == 'csv') {
            return $this->returnCsv($data);
        } elseif ($format == 'html') {
            return $this->returnHtml($data);
        }
    }

    private function returnJson($_data)
    {
        // Usando resource para padronizar a exposição de dados
        return response(PeopleResource::collection($_data))->header('Content-Type', 'application/json');
    }

    private function returnHtml($_data)
    {

        $data['people'] = $_data;

        return response(view('pessoas/table', $data))->header('Content-Type', 'text/html; charset=utf-8');
    }

    private function returnCsv($_data)
    {

        $people = $_data;

        $csvExporter = new \Laracsv\Export();
        $csv = $csvExporter->build(
            $people,
            [
                'name' => 'nome_personagem',
                'age' => 'idade_personagem',
                'movie.title' => 'titulo_filme',
                'movie.release_year' => 'ano_lancamento',
                'movie.score' => 'pontuacao_filme'
            ]
        )->getWriter()->getContent();

        $csv = str_replace(',', ';', $csv);

        return response($csv)->header('Content-Type', 'text/csv; charset=utf-8')->header('Content-Disposition', 'attachment;filename=ghibli_pessoas.csv');
    }

    public function returnPdf($data)
    {
        //TODO: retornar tabela em arquivo pdf
    }
}
