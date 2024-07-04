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
        if(Schema::hasTable('post_meta')) {
            Schema::table('post_meta', function (Blueprint $table) {
                $table->dropForeign('post_meta_post_id_foreign');
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
