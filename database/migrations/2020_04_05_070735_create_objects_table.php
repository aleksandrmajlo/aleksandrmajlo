<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('address');
            $table->string('service');

            $table->unsignedBigInteger('type')->default(0);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('site')->nullable();
            $table->json('time_work')->nullable();
            $table->text('comment')->nullable();
            $table->text('photos')->nullable();


            // Add a Point spatial data field named location
            $table->point('location')->nullable();
            // Add a Polygon spatial data field named area
            $table->polygon('area')->nullable();

            $table->integer('user_id')->unsigned();

            $table->text('slug')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('firms');
    }
}
