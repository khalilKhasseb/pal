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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('full_name');
            $table->string('email');
            $table->string('mobile');
            $table->string('address');
            $table->string('purpose');
            $table->string('classification'); // Fixed typo from 'calssification'
            $table->decimal('amount', 10, 2);
            $table->boolean('contact_before_payment')->default(false);
            $table->string('currency')->default('ILS');
            $table->string('status')->default('pending');
            $table->json('api_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_infos');
    }
};
