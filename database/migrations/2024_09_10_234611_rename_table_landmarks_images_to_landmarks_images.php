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
        // Rename table
        Schema::rename('table_landmarks_images', 'landmarks_images');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse table rename
        Schema::rename('landmarks_images', 'table_landmarks_images');
    }
};
