<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('gPermission')->default(0);
            $table->integer('donateRub')->default(0);
            $table->integer('donateVir')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('moderRequests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('fio');
            $table->integer('age');
            $table->string('residence');
            $table->string('contact');
            $table->string('server');
            $table->string('about');
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::create('Settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('UnitPay_PublicKey');
            $table->string('UnitPay_SecretKey');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('moderRequests');
    }
}
