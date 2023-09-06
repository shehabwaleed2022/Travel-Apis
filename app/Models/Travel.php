<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getNumberOfNightsAttribute()
    {
        return $this->num_of_days - 1;
    }
}
