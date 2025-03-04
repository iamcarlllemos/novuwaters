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
        Schema::create('water_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_types_id')
                ->constrained('property_types')
                ->onDelete('cascade');
            $table->integer('cubic_from');
            $table->integer('cubic_to');
            $table->float('rates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_rates');
    }
};
