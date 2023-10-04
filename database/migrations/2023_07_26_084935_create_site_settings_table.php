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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('site_title');
            $table->mediumText('meta_description')->nullable();
            $table->mediumText('meta_keywords')->nullable();
            $table->string('support_phone')->nullable();
            $table->text('company_address')->nullable();
            $table->string('app_name')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('google')->nullable();
            $table->string('vimeo')->nullable();
            $table->string('copyright')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
