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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('loan_disbursement_id')->constrained('loan_disbursements')->onDelete('cascade');
            $table->string('loan_amount');
            $table->string('interest_rate');
            $table->string('loan_period_months');
            $table->string('interest_amount');
            $table->string('total_repayment'); //full amount the borrower is required to pay for the loan.
            $table->string('total_paid'); //sum of all payments the borrower has already made.
            $table->string('out_standing_loan');  //remaining_balance   
            $table->string('start_date');
            $table->string('end_date');
            $table->enum('application_status', ['active', 'closed', 'defaulted'])->default('defaulted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
