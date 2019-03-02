<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('ip')->nullable();
            $table->string('rcon')->nullable();
            //$table->time()->nullable();
        });

        Schema::create('banlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banned');
            $table->string('reason')->default('None');
            $table->string('bannedby');
            $table->string('server');
            $table->date('unban');
            //$table->time()->nullable();
        });

        Schema::create('donate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tech_name');
            $table->string('name');
            $table->integer('server_id');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banlist');
        Schema::dropIfExists('servers');
        Schema::dropIfExists('donate');
    }
}
