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
        // Create the event_types table if it does not exist
        if (!Schema::hasTable('event_types')) {
            Schema::create('event_types', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // single column for event type
                $table->timestamps();
            });
        } else {
            // If table exists, modify it to have only the 'name' column
            Schema::table('event_types', function (Blueprint $table) {
                // Drop old columns if they exist
                $oldColumns = [
                    'burrial_celemon',
                    'child_birth',
                    'wedding',
                    'sickness',
                    'accident',
                    'school_support'
                ];

                foreach ($oldColumns as $column) {
                    if (Schema::hasColumn('event_types', $column)) {
                        $table->dropColumn($column);
                    }
                }

                // Add the new 'name' column if it does not exist
                if (!Schema::hasColumn('event_types', 'name')) {
                    $table->string('name');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_types');
    }
};