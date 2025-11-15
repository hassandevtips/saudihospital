<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Doctor extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'specialization', 'bio'];

    protected $fillable = [
        'department_id',
        'name',
        'specialization',
        'bio',
        'image',
        'email',
        'phone',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'name' => 'array',
        'specialization' => 'array',
        'bio' => 'array',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(DoctorSchedule::class);
    }

    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, 'assets')) {
            return asset($this->image);
        }
        return asset('storage/' . $this->image);
    }

    /**
     * Check if doctor is available on a specific date
     */
    public function isAvailableOnDate($date): bool
    {
        $dayOfWeek = strtolower(\Carbon\Carbon::parse($date)->format('l'));
        return $this->schedules()->where('day_of_week', $dayOfWeek)->where('is_active', true)->exists();
    }

    /**
     * Get available time slots for a specific date
     */
    public function getAvailableSlots($date): array
    {
        $dayOfWeek = strtolower(\Carbon\Carbon::parse($date)->format('l'));
        $schedule = $this->schedules()->where('day_of_week', $dayOfWeek)->where('is_active', true)->first();

        if (!$schedule) {
            return [];
        }

        $allSlots = $schedule->generateTimeSlots();

        // Get booked slots for this date
        $bookedSlots = $this->appointments()
            ->where('appointment_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('appointment_time')
            ->map(fn($time) => \Carbon\Carbon::parse($time)->format('H:i'))
            ->toArray();

        // Filter out booked slots
        return array_values(array_diff($allSlots, $bookedSlots));
    }
}
