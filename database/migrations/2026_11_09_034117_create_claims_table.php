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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('claim_ref_no')->unique();
            $table->foreignId('death_record_id')->constrained('death_records')->cascadeOnDelete();
            $table->string('claimant_name');
            $table->string('claimant_relationship');
            $table->string('claimant_phone_no');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Disbursed', 'Cancelled'])->default('Pending');
            $table->text('remarks')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('requested_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();   // change created_at to date_requested
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
