<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, 'assets')) {
            return asset($this->image);
        }
        return asset('storage/' . $this->image);
    }
}
