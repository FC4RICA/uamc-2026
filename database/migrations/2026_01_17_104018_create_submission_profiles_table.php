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
        Schema::create('submission_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('profile_id')->constrained();
            $table->foreignUuid('submission_id')->constrained();
            $table->unique(['submission_id', 'profile_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_profiles');
    }
};
