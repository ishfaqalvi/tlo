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
        Schema::create('project_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->foreignId('site_id')->references('id')->on('sites')->cascadeOnDelete();
            $table->foreignId('project_phase_id')->references('id')->on('project_phases')->cascadeOnDelete();
            $table->foreignId('assign_to')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('activity_progress_id')->references('id')->on('activity_progress')->cascadeOnDelete();
            $table->integer('milestone')->default(0);
            $table->bigInteger('start_date')->nullable();
            $table->bigInteger('end_date')->nullable();
            $table->enum('status',['Active','InActive'])->default('Active');
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
