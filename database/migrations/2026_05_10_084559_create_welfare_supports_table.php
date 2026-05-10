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
        Schema::create('welfare_supports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade'); // provider
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // recipient
            $table->foreignId('event_type_id')->constrained()->onDelete('cascade'); // reason/type
            $table->enum('mode', ['support', 'loan']); // type of assistance
            $table->decimal('amount', 10, 2);
            $table->text('description')->nullable();
            $table->decimal('repayment_amount', 10, 2)->nullable(); // only for loans
            $table->boolean('is_repaid')->default(false); // only for loans
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welfare_supports');
    }
};
