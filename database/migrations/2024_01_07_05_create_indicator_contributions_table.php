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
        Schema::create('indicator_contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicator_id')->references('id')->on('indicators')->cascadeOnDelete();
            $table->foreignId('contributer_id')->references('id')->on('indicators')->cascadeOnDelete();
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
        Schema::dropIfExists('indicator_contributions');
    }
};
