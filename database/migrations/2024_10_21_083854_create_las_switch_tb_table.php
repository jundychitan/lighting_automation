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
        Schema::create('las_switch_tb', function (Blueprint $table) {
            $table->integer('switch_id')->primary()->autoIncrement();
            $table->text('switch_name')->nullable()->default('DEFAULT NULL');
            $table->integer('switch_state')->nullable();
            $table->dateTime('heart_beat')->nullable()->default('DEFAULT NULL')->comment('Status  ( Offline After 5 Minutes ) ');
            $table->time('switch_on_time')->nullable()->default('DEFAULT NULL');
            $table->time('switch_off_time')->nullable()->default('DEFAULT NULL');
            $table->text('switch_send_cmd')->nullable()->default('DEFAULT NULL');
            $table->integer('switch_module_id')->nullable()->default('DEFAULT NULL');
            $table->integer('switch_relay_no')->nullable()->default('DEFAULT NULL');
            $table->text('switch_panel_name')->nullable()->default('DEFAULT NULL');
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
        Schema::dropIfExists('las_switch_tb');
    }
};
