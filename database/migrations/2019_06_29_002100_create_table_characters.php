<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCharacters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::dropIfExists('characters');
        Schema::enableForeignKeyConstraints();
        Schema::create('characters', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('id_api', 40)->unique();
            $table->string('name', 100);
            $table->string('gender', 100);
            $table->string('age', 30); // usando 'age' como string por conta da formatação de dados vinda da API
            $table->string('eye_color', 30);
            $table->string('hair_color', 30);
            $table->string('movie_id_api', 40);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('movie_id_api')->references('id_api')->on('movies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('characters');
    }
}
