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
        Schema::create('employee_masters', function (Blueprint $table) {
            $table->id();
            $table->string('client')->nullable();
            $table->foreignId('area_id')->constrained('area_payrolls')->onDelete('cascade');
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
            $table->unsignedInteger('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->date('join_date')->nullable();
            $table->date('resign_date')->nullable();
            $table->string('nik')->nullable();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_masters');
    }
};
