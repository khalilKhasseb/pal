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
        Schema::create('expert_cirtificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_name')->nullable(); // Certificate Name
            $table->string('certifying_authority')->nullable(); // Certifying Authority
            $table->string('authenticate_certificate_url')->nullable(); // Certificate Authentication URL
            $table->string('attachment_certification')->nullable(); // Certification Attachment
            $table->string('certification_experience')->nullable(); // Certification Experience
            $table->unsignedInteger('expert_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_cirtificates');
    }
};
