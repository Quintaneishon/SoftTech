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
            $table->string('tipo');
            $table->string('name');
            $table->string('email')->unique();
            $table->String('foto')->nullable();
            $table->String('descripcion')->nullable();
            $table->float('calificacion')->default(5.0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('proyectos')->default(0);
            $table->rememberToken();
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
    }
}
