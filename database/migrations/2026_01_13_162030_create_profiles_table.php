<?php

use App\Enums\ParticipationType;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->string('special_requirements')->nullable();
            
            $table->unsignedSmallInteger('title');
            $table->unsignedSmallInteger('academic_title');
            $table->unsignedSmallInteger('education');
            $table->unsignedSmallInteger('participation_type')->default(ParticipationType::ATTENDEE->value);
            $table->unsignedSmallInteger('presentation_type')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->unique();

            $table->foreignId('organization_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->after('education');
            $table->string('organization_other')->nullable();

            $table->foreignId('occupation_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->after('organization_id');
            $table->string('occupation_other')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
