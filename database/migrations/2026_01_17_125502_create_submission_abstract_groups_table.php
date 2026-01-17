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
        Schema::create('submission_abstract_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('submission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('abstract_group_id')->constrained()->nullOnDelete();
            $table->unsignedTinyInteger('priority'); 
            $table->unique(['submission_id', 'priority']);
            $table->unique(['submission_id', 'abstract_group_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_abstract_groups');
    }
};
