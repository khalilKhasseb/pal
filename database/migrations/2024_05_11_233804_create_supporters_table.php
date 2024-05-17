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
        Schema::create('supporters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('supported_porject');
            $table->string('supported_project_type');
            $table->string('contact_info')->nullable();
            $table->string('phone');
            $table->string('about')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supporters');
    }
};
