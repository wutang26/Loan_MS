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
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('group_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('contribution_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->decimal('amount', 12, 2);

            $table->text('reason');

            $table->enum('status', [
                'pending',
                'paid',
                'waived'
            ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
