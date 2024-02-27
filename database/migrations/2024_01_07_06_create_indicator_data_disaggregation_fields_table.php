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
        Schema::create('indicator_data_disaggregation_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disaggregation_id')->references('id')->on('indicator_data_disaggregations')->cascadeOnDelete();
            $table->foreignId('field_id')->references('id')->on('project_disaggregation_fields')->cascadeOnDelete();
            $table->bigInteger('value');
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
        Schema::dropIfExists('indicator_data_disaggregation_fields');
    }
};
