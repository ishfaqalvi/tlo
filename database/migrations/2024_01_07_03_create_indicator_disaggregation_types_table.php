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
        Schema::create('indicator_disaggregation_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicator_id')->references('id')->on('indicators')->cascadeOnDelete();
            $table->foreignId('project_disaggregation_id')->references('id')->on('project_disaggregations')->cascadeOnDelete();
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
        Schema::dropIfExists('indicator_disaggregation_types');
    }
};
