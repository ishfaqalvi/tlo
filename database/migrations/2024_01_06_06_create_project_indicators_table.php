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
        Schema::create('project_indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->string('name');
            $table->enum('format',['Numeric','Percentage','Qualitative Only']);
            $table->enum('direction',['Increasing','Decreasing'])->nullable();
            $table->enum('frequency',['Daily','Weekly','Monthly','Quarterly','Semi-Annuly','Annuly'])->nullable();
            $table->bigInteger('target');
            $table->integer('aggregated')->nullable();
            $table->text('description');
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
        Schema::dropIfExists('project_indicators');
    }
};
