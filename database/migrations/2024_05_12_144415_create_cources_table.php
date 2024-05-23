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
        Schema::create('cources', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\GoogleForm::class)->nullable();
            $table->string('title');
            $table->string('location');
            $table->string('trainer');
            $table->string('target_audince');
            $table->string('partners')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('fees')->nullable();
            $table->boolean('scholership')->default(false);
            $table->string('scholership_link')->nullable();
            $table->string('hours');
            $table->text('content');
            $table->text('objective');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cources');
    }
};
