<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::factory()->create([
            'whatsapp_phone' => '6281234567890',
            'head_tag' => "<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]?=w[l]?||[]?;w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-XXXXXX');</script> <!-- End Google Tag Manager -->",
            'body_tag' => "<!-- Google Tag Manager (noscript) --> <noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-XXXXXX' height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript> <!-- End Google Tag Manager (noscript) -->",
        ]);
    }
}
