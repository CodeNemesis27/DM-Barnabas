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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->enum('suffix', ['II', 'III', 'Jr.', 'Sr.'])->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->enum('civil_status', ['Single', 'Married', 'Separated', 'Widowed']);
            $table->string('occupation');

            // contact info
            $table->text('address');
            $table->string('phone_no');
            $table->string('alternate_phone_no')->nullable();
            $table->string('facebook_account')->nullable();

            // church affiliation
            $table->foreignId('church_id')->constrained('churches')->cascadeOnDelete();
            $table->enum('class', ['A', 'B']);
            $table->enum('status', ['Active', 'Deceased']);
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
        Schema::dropIfExists('members');
    }
};
