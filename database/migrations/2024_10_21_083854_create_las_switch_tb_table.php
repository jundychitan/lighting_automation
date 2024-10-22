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
            $table->integer('switch_id')->key()->autoIncrement();
            $table->text('switch_name')->nullable()->default(NULL);
            $table->integer('switch_state')->nullable();
            $table->dateTime('heart_beat')->nullable()->default(NULL)->comment('Status  ( Offline After 5 Minutes ) ');
            $table->time('switch_on_time')->nullable()->default(NULL);
            $table->time('switch_off_time')->nullable()->default(NULL);
            $table->text('switch_send_cmd')->nullable()->default(NULL);
            $table->integer('switch_module_id')->nullable()->default(NULL);
            $table->integer('switch_relay_no')->nullable()->default(NULL);
            $table->text('switch_panel_name')->nullable()->default(NULL);
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
        Schema::dropIfExists('las_switch_tb');
    }
};
