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
        Schema::create('member_contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->string('contribution_ref_no')->unique();
            $table->enum('payment_method', ['Cash', 'GCash']);
            $table->decimal('amount', 10, 2);
            $table->text('remarks')->nullable();
            $table->string('transaction_ref_no')->nullable(); // hidden if cash
            $table->string('proof_of_payment')->nullable();
            $table->enum('status', ['Submitted', 'Approved', 'Rejected'])->default('Submitted');
            $table->foreignId('approved_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_contributions');
    }
};
