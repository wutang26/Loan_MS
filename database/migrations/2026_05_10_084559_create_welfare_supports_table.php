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
            $table->string('group_id')->constrained();
            $table->string('event_type_id')->constrained();
            $table->string('amount');
            $table->string('description');
            $table->string('approved_by');
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
