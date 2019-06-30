<?php

// Função para fazer requisições HTTP GET e retornar o corpo da resposta
function httpGET($url = '', $params = [])
{

    $client = new GuzzleHttp\Client();
    $response = $client->request('GET', $url, [
        'query' => $params
    ]);

    return json_decode($response->getBody());
}

// Função para fazer requisições HTTP POST e retornar o corpo da resposta
function httpPOST($url = '', $body = [], $params = [])
{
    $client = new GuzzleHttp\Client();
    $response = $client->request('POST', $url, [
        'query' => $params,
        'body' => $body
    ]);

    return json_decode($response->getBody());
}
