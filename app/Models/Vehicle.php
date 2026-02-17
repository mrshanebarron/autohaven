<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Vehicle $vehicle) {
            if (empty($vehicle->slug)) {
                $vehicle->slug = Str::slug($vehicle->year . '-' . $vehicle->make . '-' . $vehicle->model . '-' . Str::random(4));
            }
            if (empty($vehicle->stock_number)) {
                $vehicle->stock_number = 'AH-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class)->orderBy('sort_order');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['make'] ?? null, fn ($q, $make) => $q->where('make', $make))
            ->when($filters['body_type'] ?? null, fn ($q, $type) => $q->where('body_type', $type))
            ->when($filters['min_price'] ?? null, fn ($q, $min) => $q->where('price', '>=', $min))
            ->when($filters['max_price'] ?? null, fn ($q, $max) => $q->where('price', '<=', $max))
            ->when($filters['min_year'] ?? null, fn ($q, $min) => $q->where('year', '>=', $min))
            ->when($filters['max_year'] ?? null, fn ($q, $max) => $q->where('year', '<=', $max))
            ->when($filters['condition'] ?? null, fn ($q, $cond) => $q->where('condition', $cond))
            ->when($filters['fuel_type'] ?? null, fn ($q, $fuel) => $q->where('fuel_type', $fuel))
            ->when($filters['search'] ?? null, fn ($q, $s) => $q->where(function ($q) use ($s) {
                $q->where('make', 'like', "%{$s}%")
                  ->orWhere('model', 'like', "%{$s}%")
                  ->orWhere('description', 'like', "%{$s}%");
            }));
    }

    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 0);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->year} {$this->make} {$this->model}";
    }

    public function getFormattedMileageAttribute(): string
    {
        return number_format($this->mileage) . ' mi';
    }
}
