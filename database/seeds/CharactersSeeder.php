<?php

use Illuminate\Database\Seeder;
use App\Models\Character;

class CharactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Character::class, 25)->create();
    }
}
