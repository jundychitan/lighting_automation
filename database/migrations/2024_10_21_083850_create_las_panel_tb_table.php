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
            $table->integer('panel_id')->key()->autoIncrement();
            $table->text('panel_name')->nullable()->default(NULL);
            $table->dateTime('created_at')->nullable()->default(NULL);
            $table->integer('created_by_user_idx')->nullable()->default(NULL);
            $table->dateTime('updated_at')->nullable()->default(NULL);
            $table->integer('modified_by_user_idx')->nullable()->default(NULL);
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
