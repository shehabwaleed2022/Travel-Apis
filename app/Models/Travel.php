<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory, Sluggable, HasUuids;

    protected $fillable = ['is_public', 'slug', 'name', 'description', 'num_of_days'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function numOfNights(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['num_of_days'] - 1,
        );
    }
}
