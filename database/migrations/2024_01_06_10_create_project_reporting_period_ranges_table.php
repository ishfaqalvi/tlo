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
        Schema::create('project_reporting_period_ranges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->references('id')->on('project_reporting_periods')->cascadeOnDelete();
            $table->string('title');
            $table->bigInteger('start_date');
            $table->bigInteger('end_date');
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
        Schema::dropIfExists('project_reporting_period_ranges');
    }
};
