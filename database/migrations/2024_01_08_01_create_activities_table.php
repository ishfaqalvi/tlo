<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->foreignId('phase_id')->nullable()->references('id')->on('project_phases')->cascadeOnDelete();
            $table->foreignId('assign_to')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('milestone')->nullable();
            $table->bigInteger('start_date')->nullable();
            $table->bigInteger('end_date')->nullable();
            $table->enum('progress',['Open','In Progress','Closed'])->nullable();
            $table->enum('status',['Green','Amber','Red'])->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('project_activities');
    }
};
