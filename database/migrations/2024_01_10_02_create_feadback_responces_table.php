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
        Schema::create('feadback_responces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feadback_id')->references('id')->on('feadbacks')->cascadeOnDelete();
            $table->enum('status',['Assign','Responce Share','Complainer Agree','Complainer DisAgree']);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('feadback_responces');
    }
};
