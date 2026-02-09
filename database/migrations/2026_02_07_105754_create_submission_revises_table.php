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
        Schema::create('submission_revises', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('submission_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('round');
            $table->string('target_email')->nullable();
            $table->text('message');
            $table->foreignId('requested_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            $table->unique(['submission_id', 'round']);
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->unsignedTinyInteger('current_revision_round')
                ->after('status')
                ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_revises');

        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('current_revision_round');
        });
    }
};
