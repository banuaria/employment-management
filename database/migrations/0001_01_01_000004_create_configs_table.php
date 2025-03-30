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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();

            $table->string('primary_logo')->nullable();
            $table->string('secondary_logo')->nullable();
            $table->string('favicon')->nullable();

            $table->string('cover_about')->nullable();
            $table->string('cover_product')->nullable();

            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();

            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('x')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->string('whatsapp_phone')->nullable();
            $table->string('whatsapp_message')->nullable();
            $table->boolean('whatsapp_float')->default(false);

            $table->text('head_tag')->nullable();
            $table->text('body_tag')->nullable();
            $table->text('google_map_tag')->nullable();

            $table->string('jjk')->nullable();
            $table->string('jkm')->nullable();
            $table->string('jht')->nullable();
            $table->string('kes')->nullable();
            $table->string('jp')->nullable();

            $table->text('ppn')->nullable();
            $table->text('pph23')->nullable();
            $table->text('MgFee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
