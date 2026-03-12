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
        Schema::table('submission_rounds', function (Blueprint $table) {
            $table->unsignedTinyInteger('current_revision_round')
                ->after('status')
                ->default(0);
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('current_revision_round');
        });

        Schema::table('submission_revisions', function (Blueprint $table) {
            $table->foreignUuid('submission_round_id')->constrained()->cascadeOnDelete();
            $table->dropColumn('submission_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submission_rounds', function (Blueprint $table) {
            $table->dropColumn('current_revision_round');
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->unsignedTinyInteger('current_revision_round')
                ->after('status')
                ->default(0);
        });

        Schema::table('submission_revisions', function (Blueprint $table) {
            $table->foreignUuid('submission_id')->constrained()->cascadeOnDelete();
            $table->dropColumn('submission_round_id');
        });
    }
};
