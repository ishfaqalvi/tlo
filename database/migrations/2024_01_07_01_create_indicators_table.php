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
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->string('name');
            $table->enum('format',['Numeric','Percentage','Qualitative Only']);
            $table->enum('direction',['Increasing','Decreasing'])->nullable();
            $table->bigInteger('target')->nullable();
            $table->bigInteger('baseline')->nullable();
            $table->bigInteger('baseline_date')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->string('aggregated')->nullable();
            $table->enum('aggregation_formula',['Sum','Subtraction','Multiplication','Division','Average'])->nullable();
            $table->string('indicator_number')->nullable();
            $table->foreignId('result_framework_id')->nullable()->references('id')->on('result_frameworks')->cascadeOnDelete();
            $table->foreignId('frequency')->nullable()->references('id')->on('project_reporting_periods')->cascadeOnDelete();
            $table->string('key_performance')->nullable();
            $table->enum('total_vs_actual_formula',['Sum','Average','Median'])->nullable();
            $table->enum('status',['Not yet started','Postponed','Paused','On Track','Minor Delays','Major Delays']);
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
        Schema::dropIfExists('indicators');
    }
};
