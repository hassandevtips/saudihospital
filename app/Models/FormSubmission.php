<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'national_id',
        'date_of_birth',
        'education_level',
        'university',
        'major',
        'current_position',
        'resume_url',
        'cover_letter',
        'message',
        'additional_data',
        'status',
        'admin_notes',
        'ip_address',
        'submitted_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'additional_data' => 'array',
        'submitted_at' => 'datetime',
    ];

    /**
     * Get available form types
     */
    public static function getTypes(): array
    {
        return [
            'internship' => 'Internship',
            'training' => 'Training',
            'volunteer' => 'Volunteer',
            'research' => 'Research Collaboration',
            'fellowship' => 'Fellowship',
            'shadowing' => 'Job Shadowing',
        ];
    }

    /**
     * Get available statuses
     */
    public static function getStatuses(): array
    {
        return [
            'pending' => 'Pending',
            'reviewed' => 'Reviewed',
            'accepted' => 'Accepted',
            'rejected' => 'Rejected',
        ];
    }

    /**
     * Get the badge color for status
     */
    public function getStatusColor(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'reviewed' => 'info',
            'accepted' => 'success',
            'rejected' => 'danger',
            default => 'gray',
        };
    }

    /**
     * Scope for filtering by type
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope for filtering by status
     */
    public function scopeWithStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
