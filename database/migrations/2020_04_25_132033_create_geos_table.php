<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('q')->unique();
            $table->point('location')->nullable();

            $table->integer('found')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('area')->nullable();
            $table->string('locality')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geos');
    }
}
