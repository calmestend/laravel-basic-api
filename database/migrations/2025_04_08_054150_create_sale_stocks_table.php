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
        Schema::create('sale_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->constrained()->nullOnDelete();
            $table->foreignId('sale_id')->constrained()->nullOnDelete();
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_stocks');
    }
};
