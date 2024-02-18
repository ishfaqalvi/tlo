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
            $table->string('aggregated')->nullable();
            $table->foreignId('frequency')->nullable()->references('id')->on('project_reporting_periods')->cascadeOnDelete();
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
