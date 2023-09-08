<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'travel_id', 'starting_date', 'ending_date', 'price'];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function price()
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
            get: fn ($value) => $value / 100,
        );
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['priceFrom'] ?? false, function ($query, $priceFrom) {
            $query->where('price', '>=', $priceFrom * 100);
        });

        $query->when($filters['priceTo'] ?? false, function ($query, $priceTo) {
            $query->where('price', '<=', $priceTo * 100);
        });

        $query->when($filters['dateFrom'] ?? false, function ($query, $dateFrom) {
            $query->where('starting_date', '>=', $dateFrom);
        });

        $query->when($filters['dateTo'] ?? false, function ($query, $dateTo) {
            $query->where('ending_date', '<=', $dateTo);
        });

        $query->when($filters['sortBy'] ?? false, function ($query, $sortBy) {
            $query->sortBy($sortBy);
        });

        $query->when($filters['sortOrder'] ?? false, function ($query, $sortOrder) {
            $query->sortOrder($sortOrder);
        });
    }

}
