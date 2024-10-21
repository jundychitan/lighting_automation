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
        Schema::create('user_tb', function (Blueprint $table) {
            $table->integer('user_id')->primary()->autoIncrement();
            $table->text('user_name');
            $table->text('user_real_name');
            $table->text('user_password');
            $table->string('user_type', 100);
            $table->text('created_at');
            $table->integer('created_by_user_idx')->nullable()->default('DEFAULT NULL');
            $table->text('updated_at');
            $table->integer('modified_by_user_idx')->nullable()->default('DEFAULT NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tb');
    }
};
