<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'title',
        'slug',
        'cover',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productSubcategories()
    {
        return $this->hasMany(ProductSubcategory::class);
    }

    public function productTags()
    {
        return $this->hasMany(ProductTag::class);
    }
}
