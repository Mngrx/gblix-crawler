<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Movie;
use App\Models\Character;

class PersistanceTest extends TestCase
{
    use DatabaseTransactions;

    public function testPersistanceOfMyModels()
    {
        $movieTest = [
            'id_api' => '94ed6268-6419-40ef-a94d-31622de2cb92',
            'title' => 'Fight Club',
            'description' => 'A very crazy film!',
            'director' => 'David Fincher',
            'producer' => 'Guy Moon',
            'release_year' => 1999,
            'score' => 88,
            'created_at' => date('Y-m-d H:i:s')
        ];

        factory(Movie::class)->create($movieTest);

        //$movieTest['score'] = 50;

        $this->assertDatabaseHas('movies', $movieTest);

        $characterTest = [
            'id_api' => 'ad895d24-4a5e-40c2-82c8-b19963612a12',
            'name' => 'Igor Nogueira',
            'gender' => 'Male',
            'age' => 'Young Adult',
            'eye_color' => 'Brown',
            'hair_color' => 'Brown',
            'movie_id_api' => $movieTest['id_api'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        factory(Character::class)->create($characterTest);

        $this->assertDatabaseHas('characters', $characterTest);

    }
}
