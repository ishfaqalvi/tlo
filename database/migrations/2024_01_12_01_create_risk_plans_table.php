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
        Schema::create('risk_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->text('description');
            $table->text('consequence');
            $table->enum('probability',['High','Medium','Low']);
            $table->enum('impact',['High','Medium','Low']);
            $table->enum('priority',['1','2','3']);
            $table->enum('level',['9','6','3','2']);
            $table->enum('strategy',['Avoid','Mitigate','Transfer','Accepted']);
            $table->text('responce');
            $table->string('owner');
            $table->bigInteger('action_date');
            $table->enum('status',['Started','Open','Closed']);
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
        Schema::dropIfExists('risk_plans');
    }
};
