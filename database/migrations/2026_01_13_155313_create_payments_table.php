<?php

use App\Enums\PaymentStatus;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->dateTime('payment_at')->nullable();
            $table->string('account_name')->nullable();
            $table->string('from_bank')->nullable();
            $table->string('drive_file_id');
            $table->string('original_file_name')->default('undefined');
            $table->unsignedSmallInteger('status')->default(PaymentStatus::SUBMITTED->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
