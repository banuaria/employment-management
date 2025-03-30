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
        Schema::table('makans', function($table) {
            $table->string('total_mel')->after('total')->nullable();
            $table->string('total_unit')->after('total_mel')->nullable();
            $table->string('total_loading')->after('total_unit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('makans', function($table) {
            $table->dropColumn('total_mel');
            $table->dropColumn('total_unit');
            $table->dropColumn('total_loading');
        });
    }
};
