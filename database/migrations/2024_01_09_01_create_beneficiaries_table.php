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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name');
            $table->enum('gender', ['Male', 'Female']);
            $table->enum('marital_status', ['Single', 'Engaged', 'Married', 'Divorced', 'Widow']);
            $table->string('province');
            $table->string('district');
            $table->string('village');
            $table->string('contact');
            $table->foreignId('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->string('type_of_assistance');
            $table->enum('residential_type', ['Local Resident', 'Kochi', 'IDP', 'Refugee']);
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('beneficiaries');
    }
};
