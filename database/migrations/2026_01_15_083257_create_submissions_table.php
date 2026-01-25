<?php

use App\Enums\SubmissionStatus;
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
        Schema::create('submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('submitted_by')->constrained('users', 'id');
            $table->unsignedSmallInteger('presentation_type');
            $table->text('title_th');
            $table->text('title_en');
            $table->text('keywords')->nullable();
            $table->string('drive_folder_id')->nullable();
            $table->unsignedSmallInteger('status')->default(SubmissionStatus::PENDING->value);
            $table->timestamps();
        });
    }

    // /**
    //  * Reverse the migrations.
    //  */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
