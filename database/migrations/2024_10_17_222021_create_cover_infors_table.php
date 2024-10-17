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
        Schema::create('cover_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Post::class)
            ->constrained()
            ->cascadeOnDelete()
            ->cascadeOnUpdate()
            ->nullable();
            $table->string('title');
            $table->string('source')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cover_infors');
    }
};
