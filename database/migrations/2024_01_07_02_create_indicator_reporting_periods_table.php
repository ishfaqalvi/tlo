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
        Schema::create('indicator_reporting_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicator_id')->references('id')->on('indicators')->cascadeOnDelete();
            $table->foreignId('reporting_period_id')->references('id')->on('project_reporting_periods')->cascadeOnDelete();
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
        Schema::dropIfExists('indicator_reporting_periods');
    }
};
