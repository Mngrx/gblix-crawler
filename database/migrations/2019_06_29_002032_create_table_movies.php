<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('movies', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('id_api', 40)->unique();
            $table->string('title', 100);
            $table->text('description');
            $table->string('director', 100);
            $table->string('producer', 100);
            $table->year('release_year');
            $table->tinyInteger('score');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('movies');
    }
}
