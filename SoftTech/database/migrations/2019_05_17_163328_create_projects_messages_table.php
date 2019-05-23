<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('remitente');
            $table->string('destinatario');
            $table->text('mensaje');
            $table->date('avance_1')->nulleable();
            $table->string('entrega_1')->default('N');
            $table->date('avance_2')->nulleable();
            $table->string('enttrega_2')->default('N');
            $table->date('avance_final')->nulleable();
            $table->string('entrega_final')->default('N');
            $table->unsignedInteger('project_id');
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
        Schema::dropIfExists('projects_messages');
    }
}
