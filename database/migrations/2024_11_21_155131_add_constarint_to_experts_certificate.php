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
        Schema::table('expert_cirtificates', function (Blueprint $table) {
            $table->unsignedBigInteger('expert_id')->nullable(false)->change();
            $table->foreign('expert_id')->references('id')
            ->on('experts')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->unsignedBigInteger('expert_id')->nullable()->change();
            $table->dropForeign('expert_cirtificates_expert_id_foreign');
        });
    }
};
