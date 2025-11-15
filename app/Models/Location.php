<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'address', 'description'];

    protected $fillable = [
        'name',
        'address',
        'description',
        'latitude',
        'longitude',
        'phone',
        'email',
        'marker_icon',
        'working_hours',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'name' => 'array',
        'address' => 'array',
        'description' => 'array',
        'working_hours' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Get formatted working hours for a specific day
     */
    public function getWorkingHoursForDay(string $day): ?array
    {
        if (!$this->working_hours || !isset($this->working_hours[$day])) {
            return null;
        }

        return $this->working_hours[$day];
    }

    /**
     * Check if location is open on a specific day
     */
    public function isOpenOnDay(string $day): bool
    {
        $hours = $this->getWorkingHoursForDay($day);
        return $hours && ($hours['is_open'] ?? false);
    }

    /**
     * Get all working days
     */
    public function getWorkingDays(): array
    {
        if (!$this->working_hours) {
            return [];
        }

        return array_filter($this->working_hours, function ($day) {
            return $day['is_open'] ?? false;
        });
    }
}
