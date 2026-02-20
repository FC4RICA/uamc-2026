<?php

use App\Enums\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('payments')
            ->where('status', 4)
            ->update(['status' => PaymentStatus::PENDING->value]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('payments')
            ->where('status', PaymentStatus::PENDING->value)
            ->update(['status' => 4]);
    }
};
