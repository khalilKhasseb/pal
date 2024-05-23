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
        Schema::create('supporters_supported_projects_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supported_project_type_id')->nullable();
            $table->unsignedBigInteger('supporter_id')->nullable();


            $table->foreign('supported_project_type_id' , 'sup_pr_ty_sup_pr_ty_id_forign')
                ->references('id')
                ->on('supported_project_types')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('supporter_id' ,'sup_pr_ty_sup_id_forign')
                ->references('id')->on('supporters')
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
        Schema::dropIfExists('supporter_supported_project_types');
    }
};
