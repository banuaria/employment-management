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
        Schema::table('stands', function($table) {
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });
        Schema::table('denda_slas', function($table) {
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });
        Schema::table('retributions', function($table) {
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });
        Schema::table('insentifs', function($table) {
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });
        Schema::table('lainyas', function($table) {
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });
        Schema::table('previous_months', function($table) {
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });
        Schema::table('cut_salaries', function($table) {
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });
        Schema::table('cleanings', function($table) {
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });

        Schema::table('denda_bbms', function($table) {
            $table->unsignedInteger('status')->comment('1: REGULER | 2: LOADING | 3: HARIAN')->nullable();
        });

    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stands', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('denda_slas', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('retributions', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('insentifs', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('lainyas', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('previous_months', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('cut_salaries', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('cleanings', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('denda_bbms', function($table) {
            $table->dropColumn('status');
        });
    }
};
