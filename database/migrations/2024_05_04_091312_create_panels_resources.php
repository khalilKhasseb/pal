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
        Schema::create('resourcable', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('panel_id');
            $table->unsignedBigInteger('resourcable_id');
            $table->string('resourcable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panels_resources');
    }
};
