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
        Schema::create('las_panel_tb', function (Blueprint $table) {
            $table->integer('panel_id')->primary()->autoIncrement();
            $table->text('panel_name')->nullable()->default('DEFAULT NULL');
            $table->dateTime('created_at')->nullable()->default('DEFAULT NULL');
            $table->integer('created_by_user_idx')->nullable()->default('DEFAULT NULL');
            $table->dateTime('updated_at')->nullable()->default('DEFAULT NULL');
            $table->integer('modified_by_user_idx')->nullable()->default('DEFAULT NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('las_panel_tb');
    }
};
