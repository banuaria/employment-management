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
        Schema::table('employ_bpjs', function($table) {
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('cascade');
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employ_bpjs', function($table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn('status');
        });
    }
};
