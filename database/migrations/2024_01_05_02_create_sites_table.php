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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_type_id')->references('id')->on('site_types')->cascadeOnDelete();
            $table->foreignId('province_id')->references('id')->on('provinces')->cascadeOnDelete();
            $table->string('name');
            $table->string('office');
            $table->string('contact_name');
            $table->string('contact_number');
            $table->string('latitude');
            $table->string('longitude');
            $table->text('note')->nullable();
            $table->enum('status',['Active','InActive'])->default('Active');
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
        Schema::dropIfExists('sites');
    }
};
