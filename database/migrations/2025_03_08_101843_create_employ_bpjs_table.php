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
        Schema::create('employ_bpjs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employee_masters')->onDelete('cascade');
            $table->string('jht');
            $table->string('jkk');
            $table->string('jkm');
            $table->string('jp');
            $table->string('kes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employ_bpjs');
    }
};
