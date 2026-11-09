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
        Schema::create('death_records', function (Blueprint $table) {
            $table->id();
            $table->string('death_record_ref_no')->unique();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->date('date_of_death');
            $table->text('place_of_death');
            $table->enum('death_cause_type', ['Accidental', 'Illness or disease', 'Suicide', 'Homicide', 'Disaster-related', 'Undetermined']);
            $table->text('cause_of_death');
            $table->string('death_cert_number')->nullable();
            $table->string('death_cert_image')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('death_records');
    }
};
