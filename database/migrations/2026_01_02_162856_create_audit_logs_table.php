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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

        $table->foreignId('performed_by')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->string('action'); // assign_role, revoke_permission, etc
        $table->string('target_type'); // User / Role
        $table->unsignedBigInteger('target_id');

        $table->text('description');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
