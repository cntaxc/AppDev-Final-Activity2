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
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('productname'); // product name
        $table->decimal('currentinventory', 10, 2); // numeric with 2 decimals
        $table->decimal('averagesales', 10, 2);    // numeric with 2 decimals
        $table->integer('replenishdays');          // integer
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
