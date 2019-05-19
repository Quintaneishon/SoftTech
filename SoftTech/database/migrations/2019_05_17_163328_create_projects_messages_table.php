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
            $table->char('read')->default('N');
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
