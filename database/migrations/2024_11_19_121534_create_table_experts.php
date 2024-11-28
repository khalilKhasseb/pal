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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('sir_name_ar')->nullable(false); // Sir Name (Arabic)
            $table->string('sir_name_en')->nullable(false); // Sir Name (English)
            $table->enum('gender', ['male', 'female'])->nullable(false); // Gender
            $table->string('email')->nullable(false); // Email
            $table->string('mobile_number')->nullable(false); // Mobile Number
            $table->unsignedInteger('city_id')->nullable(false); // City / Village
            $table->unsignedInteger('governorate_id')->nullable(false); // Governorate
            $table->date('date_of_birth')->nullable(false); // Date of Birth
            $table->string('university')->nullable(false); // University
            $table->string('ba_major')->nullable(false); // BA Major
            $table->year('graduation_year')->nullable(false); // Graduation Year
            $table->string('phd_degrees')->nullable(); // PHD Degrees
            
            $table->string('other_degrees')->nullable(); // Other Degrees
            
            $table->integer('experience')->unsigned()->default(1); // Experience (Minimum 1)
            $table->string('attachment_personal_photo')->nullable(false); // Personal Photo
            $table->boolean('agreement_check')->default(false); // Agreement Checkbox
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_experts');
    }
};
