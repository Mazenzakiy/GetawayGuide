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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->integer('phone_number');
            $table->integer('num_guests');
            $table->string('check_in_date', 200);
            $table->string('destination', 200);
            $table->integer('price');
            // $table->unsignedInteger('user_id')->index('user_id');
            $table->foreignId('user_id')->constrained();
            $table->string('status', 200)->default('Processing');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
