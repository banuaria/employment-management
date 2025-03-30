<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_category_id',
        'post_subcategory_id',
        'highlight',
        'status',
        'thumbnail',
        'cover',
        'title',
        'slug',
        'content',
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
            'status' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function postSubcategory()
    {
        return $this->belongsTo(PostSubcategory::class);
    }

    public function postTags()
    {
        return $this->belongsToMany(PostTag::class)->withTimestamps();
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
