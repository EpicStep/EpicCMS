<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tech_name');
            $table->string('title');
            $table->string('body');
            $table->string('mini_body');
            $table->string('image');
            $table->string('write_by');
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tech_name');
            $table->text('html');
            $table->text('css');
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
        Schema::dropIfExists('news');
        Schema::dropIfExists('pages');
    }
}
