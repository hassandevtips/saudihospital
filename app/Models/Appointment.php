<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'patient_name',
        'patient_email',
        'patient_phone',
        'message',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
