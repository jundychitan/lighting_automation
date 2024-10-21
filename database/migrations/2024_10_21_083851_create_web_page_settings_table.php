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
        Schema::create('web_page_settings', function (Blueprint $table) {
            $table->integer('default_web_settings')->nullable()->default(1);
            $table->string('navigation_header_title', 255)->nullable()->default('Lighting Automation System')->comment('navbar_header_title');
            $table->integer('image_logo')->nullable()->default('DEFAULT NULL');
            $table->double('header_navigation_width')->nullable()->default('70');
            $table->double('login_page_logo_width')->nullable()->default('DEFAULT NULL');
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
        Schema::dropIfExists('web_page_settings');
    }
};
