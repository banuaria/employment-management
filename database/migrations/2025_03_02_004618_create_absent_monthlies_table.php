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
        Schema::create('absent_monthlies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employee_masters')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
            $table->date('month_year');
            $table->string('absent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absent_monthlies');
    }
};
