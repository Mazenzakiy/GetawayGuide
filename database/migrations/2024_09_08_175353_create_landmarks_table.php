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
        Schema::create('landmarks', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('city_id');
            // Create the foreign key constraint
            $table->foreignId('city_id')->constrained();

            // $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('name');
            $table->text('desc');
            $table->string('video')->nullable();
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landmarks');
    }
};
