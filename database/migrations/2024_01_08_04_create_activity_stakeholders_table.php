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
        Schema::create('activity_stakeholders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->references('id')->on('activities')->cascadeOnDelete();
            $table->foreignId('stakeholder_id')->references('id')->on('stakeholders')->cascadeOnDelete();
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
        Schema::dropIfExists('activity_stakeholders');
    }
};
