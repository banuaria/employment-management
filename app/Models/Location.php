<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_category_id',
        'status',
        'name',
        'address',
        'email',
        'phone',
        'mobile',
        'fax',
        'detail',
        'desc',
        'country',
        'province',
        'city',
        'latitude',
        'longitude',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function locationCategory()
    {
        return $this->belongsTo(LocationCategory::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
