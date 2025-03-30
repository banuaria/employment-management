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
        Schema::create('employee_master_vendor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_master_id');
            $table->unsignedBigInteger('vendor_id');
    
            // Foreign keys
            $table->foreign('employee_master_id')->references('id')->on('employee_masters')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_master_vendor');
    }
};
