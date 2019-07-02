<style>
    table {
    border-collapse: collapse;
    }

    table, th, td {
    border: 1px solid black;
    }
</style>
<table>
    <thead>
        <tr>
            <th>Nome do Personagem</th>
            <th>Idade do Personagem</th>
            <th>Título do Filme</th>
            <th>Ano de Lançamento do Filme</th>
            <th>Pontuação Rotten Tomato</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($people as $person)
        <tr>
            <td>{{ $person->name }}</td>
            <td>{{ $person->age }}</td>
            <td>{{ $person->movie->title }}</td>
            <td>{{ $person->movie->release_year }}</td>
            <td>{{ $person->movie->score }}</td>
        </tr>
        @endforeach
    </tbody>
</table>



