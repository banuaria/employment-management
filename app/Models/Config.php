<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary_logo',
        'secondary_logo',
        'favicon',

        'cover_about',
        'cover_product',

        'company_name',
        'address',
        'email',
        'phone',
        'mobile',
        'fax',

        'instagram',
        'facebook',
        'x',
        'linkedin',
        'youtube',
        'tiktok',

        'meta_title',
        'meta_desc',
        'meta_keywords',

        'whatsapp_phone',
        'whatsapp_message',
        'whatsapp_float',

        'head_tag',
        'body_tag',
        'google_map_tag',
    ];

    protected function casts(): array
    {
        return [
            'whatsapp_float' => 'boolean',
        ];
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('configData');
        });
    }
}
