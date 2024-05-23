<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supporters_supported_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supported_project_id')->nullable();
            $table->unsignedBigInteger('supporter_id')->nullable();
            $table->foreign('supported_project_id')
                ->references('id')
                ->on('supported_projects')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('supporter_id')
                ->references('id')
                ->on('supporters')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supporter_supported_project');
    }
};
