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
        Schema::create('makans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employee_masters')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->date('month_year');
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
            $table->string('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('makans');
    }
};
