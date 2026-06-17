<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Artisan Model
 * 
 * Represents an individual craftsperson.
 * Stores their bio, specialty, awards, and personal story.
 */
class Artisan extends Model
{
    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'specialty',
        'years_experience',
        'bio',
        'philosophy',
        'signature_style',
        'certifications',
        'awards',
        'achievements',
        'photo',
        'action_photo',
        'instagram_handle',
        'phone',
        'email',
        'specialty_products',
        'is_featured',
        'display_order',
    ];

    protected $casts = [
        'certifications' => 'array',
        'awards' => 'array',
        'specialty_products' => 'array',
        'years_experience' => 'integer',
        'is_featured' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Get the brand that owns this artisan
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Scope: Get featured artisans
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->orderBy('display_order');
    }

    /**
     * Get formatted years of experience
     */
    public function getExperienceText(): string
    {
        if (!$this->years_experience) {
            return 'Pengalaman bertahun-tahun';
        }

        return match (true) {
            $this->years_experience < 2 => "Kurang dari 2 tahun pengalaman",
            $this->years_experience < 5 => "{$this->years_experience} tahun pengalaman",
            $this->years_experience < 10 => "Lebih dari {$this->years_experience} tahun pengalaman",
            default => "Master craftsperson dengan {$this->years_experience}+ tahun pengalaman"
        };
    }

    /**
     * Get Instagram profile URL
     */
    public function getInstagramUrl(): ?string
    {
        if (!$this->instagram_handle) {
            return null;
        }

        return "https://instagram.com/{$this->instagram_handle}";
    }
}
