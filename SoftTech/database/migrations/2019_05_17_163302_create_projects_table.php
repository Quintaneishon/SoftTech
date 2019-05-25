<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('desarrollador_id');
            $table->unsignedInteger('cliente_id');
            $table->string('name');
            $table->date('avance_1')->nullable();
            $table->char('entrega_1')->default('N');
            $table->date('avance_2')->nullable();
            $table->char('entrega_2')->default('N');
            $table->date('avance_final')->nullable();
            $table->char('entrega_final')->default('N');
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
        Schema::dropIfExists('projects');
    }
}
