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
        Schema::create('sale__summaries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('sale_id', 36);
            $table->string('customer_id', 36);
            $table->string('employee_id', 36);
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale__summaries');
    }
};
