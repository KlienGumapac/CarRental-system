<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'license_plate',
        'make',
        'model',
        'year',
        'color',
        'car_type',
        'transmission',
        'fuel_type',
        'daily_rate',
        'availability',
        'mileage',
        'seating_capacity',
        'insurance',
        'last_service',
        'condition',
        'images',
    ];

    protected $casts = [
        'daily_rate' => 'decimal:2',
        'year' => 'integer',
        'mileage' => 'integer',
        'seating_capacity' => 'integer',
        'last_service' => 'date',
        'images' => 'array',
    ];

    /**
     * Get the images attribute with proper handling for null values
     */
    public function getImagesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Set the images attribute
     */
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = $value ? json_encode($value) : null;
    }
}
