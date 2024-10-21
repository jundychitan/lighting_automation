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
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('log_name', 255)->index()->nullable()->default('DEFAULT NULL');
            $table->text('description');
            $table->string('subject_type', 255)->nullable()->default('DEFAULT NULL');
            $table->unsignedBigInteger('subject_id')->nullable()->default('DEFAULT NULL');
            $table->string('causer_type', 255)->nullable()->default('DEFAULT NULL');
            $table->unsignedBigInteger('causer_id')->nullable()->default('DEFAULT NULL');
            $table->longText('properties')->nullable()->default('DEFAULT NULL');
            $table->timestamp('created_at')->nullable()->default('DEFAULT NULL');
            $table->timestamp('updated_at')->nullable()->default('DEFAULT NULL');
            $table->index(['subject_type', 'subject_id']);
            $table->index(['causer_type', 'causer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
