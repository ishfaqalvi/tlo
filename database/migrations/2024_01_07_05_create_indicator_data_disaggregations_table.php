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
        Schema::create('indicator_data_disaggregations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->references('id')->on('indicator_data_collections')->cascadeOnDelete();
            $table->foreignId('disaggregation_id')->nullable()->references('id')->on('project_disaggregations')->cascadeOnDelete();
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
        Schema::dropIfExists('indicator_data_disaggregations');
    }
};
