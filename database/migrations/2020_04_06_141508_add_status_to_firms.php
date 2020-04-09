<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToFirms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('firms', function (Blueprint $table) {
            $table->boolean('status')->default(false);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('firms', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
}
