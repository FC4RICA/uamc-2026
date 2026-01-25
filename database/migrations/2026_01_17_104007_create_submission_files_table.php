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
        Schema::create('submission_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('submission_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // abstract, extended_abstract, poster, lor
            $table->string('drive_file_id');
            $table->string('original_file_name');
            $table->integer('version')->default(1);
            $table->boolean('is_current')->default(true);
            $table->unique(['submission_id', 'type', 'version']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_files');
    }
};
