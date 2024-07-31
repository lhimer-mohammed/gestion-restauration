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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servant_id')->constrained('servants')->onDelete('cascade');
            $table->integer('quantity')->default(1); // Ensure a default value if necessary
            $table->decimal('total_price', 8, 2)->default(0);
            $table->decimal('total_received', 8, 2)->default(0);
            $table->decimal('change', 8, 2)->default(0);
            $table->string('payment_type')->default('cash');
            $table->string('payment_status')->default('paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
