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
        Schema::table('submission_abstract_groups', function (Blueprint $table) {
            // Drop old FK
            $table->dropForeign(['abstract_group_id']);

            // Re-add with cascade
            $table->foreign('abstract_group_id')
                ->references('id')
                ->on('abstract_groups')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submission_abstract_groups', function (Blueprint $table) {
            $table->dropForeign(['abstract_group_id']);

            $table->foreign('abstract_group_id')
                ->references('id')
                ->on('abstract_groups')
                ->nullOnDelete();
        });
    }
};
