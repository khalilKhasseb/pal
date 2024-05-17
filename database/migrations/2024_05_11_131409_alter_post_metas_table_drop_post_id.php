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
        if(Schema::hasTable('post_metas')) {
            Schema::table('post_metas', function (Blueprint $table) {
                $table->dropForeign('post_metas_post_id_foreign');
                // dd($table);
                $table->dropColumn('post_id');
            });
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
