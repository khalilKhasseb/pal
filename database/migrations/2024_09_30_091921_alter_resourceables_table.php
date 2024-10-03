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
        Schema::table('resourcables', function (Blueprint $table) {
            $table->foreign('panel_id')
                ->references('id')
                ->on('panels')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            
            $table->unique(['panel_id', 'resourcables_id', 'resourcables_type']);    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resourcables', function (Blueprint $table) {
            //
        });
    }
};
