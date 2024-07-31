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
        Schema::create('sales_table', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("table_id")->unsigned();
            $table->bigInteger("sales_id")->unsigned();
            $table->foreign("table_id")->references("id")->on("tables")->onDelete("cascade");
            $table->foreign("sales_id")->references("id")->on("sales")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_table');
    }
};
