<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
            set: fn($value) => $value * 100,
            get: fn($value) => $value / 100,
        );
    }

}
