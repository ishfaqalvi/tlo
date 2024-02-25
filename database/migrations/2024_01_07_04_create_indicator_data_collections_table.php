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
        Schema::create('indicator_data_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicator_id')->references('id')->on('indicators')->cascadeOnDelete();
            $table->bigInteger('collected_value')->nullable();
            $table->bigInteger('date');
            $table->string('identifier');
            $table->foreignId('site_id')->references('id')->on('sites')->cascadeOnDelete();
            $table->string('evidence')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('intdicator_data_collections');
    }
};
