<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Department extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'name' => 'array',
        'description' => 'array',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
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
