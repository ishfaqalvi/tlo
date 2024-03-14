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
        Schema::create('feadbacks', function (Blueprint $table) {
            $table->id();
            $table->enum('channel',[
                'Complaint Box',
                'Designated Community Focal Point',
                'Email',
                'Phone Line',
                'Text Message',
                'Community Meeting',
                'Face-to-Face',
                'Other Bright Ideas'
            ]);
            $table->string('other_channel')->nullable();
            $table->string('name');
            $table->string('contact_number');
            $table->string('address');
            $table->enum('complainer_type',[
                'Beneficiary',
                'Non-Beneficiary',
                'Partner & TLO Staff',
                'Other Stakeholders'
            ]);
            $table->foreignId('complaint_type_id')->references('id')->on('complaint_types')->cascadeOnDelete();
            $table->string('attachment')->nullable();
            $table->text('description')->nullable();
            $table->enum('status',[
                'Pending',
                'Assign',
                'Processing',
                'Reprocessing',
                'Closed'
            ])->default('Pending');
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
        Schema::dropIfExists('feadbacks');
    }
};
