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
        Schema::create('activity_budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->references('id')->on('activities')->cascadeOnDelete();
            $table->string('description');
            $table->bigInteger('budget_amount');
            $table->bigInteger('actual_spent');
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
        Schema::dropIfExists('activity_budgets');
    }
};
