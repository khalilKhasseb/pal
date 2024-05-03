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
        Schema::create('google_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('google_file_id');
            $table->string('type')->default('form');
            $table->string('google_mimeType')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_forms');
    }
};
