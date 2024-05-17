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
        Schema::table('post_metas', function (Blueprint $table) {
            //$table->dropConstrainedForeignIdFor(App\Models\Post::class , 'post_id');
            $table->dropColumn('post_id');
            //$table->unsignedBigInteger('post_id')->nullable();
            //$table->foreign('post_id')->references('id')->on('post_meta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        

        

    }
};
