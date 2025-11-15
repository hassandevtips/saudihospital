<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerApplication extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'career_vacancy_id',
        'name',
        'email',
        'phone',
        'current_position',
        'resume_url',
        'cover_letter',
        'ip_address',
        'submitted_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(CareerVacancy::class, 'career_vacancy_id');
    }
}
