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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name');
            $table->bigInteger('start_date');
            $table->bigInteger('end_date');
            $table->string('funding')->nullable();
            $table->string('donnor')->nullable();
            $table->string('partner')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('province_id')->nullable()->references('id')->on('provinces')->cascadeOnDelete();
            $table->foreignId('assigned_to')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->cascadeOnDelete();
            $table->enum('status',['Pipeline/Identification','Implementation','Finalisation','Closed','Cancelled','Suspended'])->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
