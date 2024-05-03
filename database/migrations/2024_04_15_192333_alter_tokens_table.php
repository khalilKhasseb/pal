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
        // Schema::table('tokens' , function(Blueprint $table){
        //     $table->renameColumn('token' , 'access_token');
        //     $table->string('expires_in');
        //     $table->string('scope');
        //     $table->string('token_type');
        //     $table->string('created');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
