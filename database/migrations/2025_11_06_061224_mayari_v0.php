<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //create all table for the menstrual health app
        //record table contains all the relevant information regarding the client
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('user_id')->constrained();
            $table->decimal('weight', 32)->nullable();
            $table->decimal('height', 32)->nullable();
            $table->decimal('bmi', 32)->nullable();
            $table->string('mood', 45)->nullable();
            $table->dateTime('cycle_start');
            $table->dateTime('predicted_cycle');  
        });

        //doctors table contain all the doctors and their information
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('doc_name', 45);
            $table->string('doc_location');
            $table->string('doc_link');
         });  

        //directories table contain all the recommended doctors for the client
        Schema::create('directories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('record_id')->constrained();
            $table->foreignId('doctor_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //drop tables
        Schema::dropIfExists('directories');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('records');
    }
};
