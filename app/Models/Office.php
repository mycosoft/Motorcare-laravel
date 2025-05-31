<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'address',
        'city',
        'region',
        'phone',
        'email',
        'latitude',
        'longitude',
        'services',
        'working_hours',
        'manager_name',
        'manager_phone',
        'description',
        'image',
        'is_active'
    ];

    protected $casts = [
        'services' => 'array',
        'working_hours' => 'array',
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    public function getServicesListAttribute()
    {
        return $this->services ? implode(', ', $this->services) : '';
    }

    public function getWorkingHoursFormattedAttribute()
    {
        if (!$this->working_hours) return 'Contact for hours';

        $hours = $this->working_hours;
        if (isset($hours['monday_friday']) && isset($hours['saturday'])) {
            return "Mon-Fri: {$hours['monday_friday']}, Sat: {$hours['saturday']}";
        }

        return 'Contact for hours';
    }
}
