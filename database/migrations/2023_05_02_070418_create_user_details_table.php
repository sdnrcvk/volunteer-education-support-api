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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constraint();
            $table->string('portfolio_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->text('user_about')->nullable();
            $table->string('task_definition')->nullable();
            $table->date('birthdate');
            $table->string('phone_number')->unique();
            $table->enum('gender', ['male', 'female', 'unselected'])->default('unselected');
            $table->foreignId('city_id')->constraint();
            $table->foreignId('district_id')->constraint();
            $table->string('image_path')->nullable();
            $table->enum('user_type', ['admin', 'user'])->default('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
