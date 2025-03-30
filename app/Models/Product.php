<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'product_subcategory_id',
        'highlight',
        'status',
        'thumbnail',
        'title',
        'slug',
        'content',
        'usage',
        'meta_title',
        'meta_desc',
        'meta_keywords',
        'created_by',
        'updated_by',
        'published_by',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'highlight' => 'boolean',
            'status' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productSubcategory()
    {
        return $this->belongsTo(ProductSubcategory::class);
    }

    public function productTags()
    {
        return $this->belongsToMany(ProductTag::class)->withTimestamps();
    }

    public function productStores()
    {
        return $this->belongsToMany(Store::class)->withPivot('url')->withTimestamps();
    }

    public function productPhotos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function publishedBy()
    {
        return $this->belongsTo(User::class, 'published_by');
    }
}
