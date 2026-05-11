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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('email');
            $table->string('phone');
            $table->string('phone2');
            $table->json('working_hours')->nullable();
            $table->string('facebook_link');
            $table->string('instagram_link');
            $table->string('youtube_link');
            $table->integer('travelers')->default(0);
            $table->integer('hotels')->default(0);
            $table->integer('completed_tours')->default(0);
            $table->integer('experience_years')->default(0);
            $table->integer('number_partners')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
