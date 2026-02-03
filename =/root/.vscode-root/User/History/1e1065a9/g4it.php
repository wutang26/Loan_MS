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

            // User relationship
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Loan details
            $table->decimal('loan_amount', 12, 2);
            $table->decimal('interest_rate', 5, 2)->default(0.10); // e.g. 10.50%
            $table->integer('loan_period_months');
            $table->string('purpose')->nullable();

            // Calculated fields
            $table->decimal('total_repayment', 12, 2);
            $table->decimal('outstanding_loan', 12, 2);
            $table->decimal('monthly_installment', 12, 2)->nullable();

            // Dates
            $table->date('application_date');  
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Application status
            $table->enum('application_status', ['pending', 'approved', 'rejected','disbursed'])
                ->default('pending');

            // Admin tracking
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();

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
