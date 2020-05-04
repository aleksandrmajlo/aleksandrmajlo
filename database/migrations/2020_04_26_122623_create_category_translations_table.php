<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_translations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('language');
            $table->string('title')->default('');
            $table->text('content')->nullable();
            $table->integer('categorie_id');
            /*
            $table->foreign('categorie_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            */
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
        Schema::dropIfExists('category_translations');
    }
}
