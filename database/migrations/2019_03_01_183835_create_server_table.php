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
            $table->integer('shop')->default('0');
            $table->timestamps();
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

        Schema::create('donates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tech_name');
            $table->string('name');
            $table->integer('server_id');
            $table->integer('price');
        });

        Schema::create('shop_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('server_id');
            $table->string('name');
            $table->string('image');
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
        Schema::dropIfExists('banlists');
        Schema::dropIfExists('servers');
        Schema::dropIfExists('donates');
        Schema::dropIfExists('shop_items');
    }
}
