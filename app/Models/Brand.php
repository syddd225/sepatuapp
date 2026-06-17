<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Artisan;

/**
 * Brand Model
 * 
 * Represents the brand/company identity.
 * Stores mission, vision, founder story, and brand values.
 */
class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'story',
        'mission',
        'vision',
        'values',
        'founder_name',
        'founder_bio',
        'founder_image',
        'founded_year',
        'location',
        'sustainability_note',
        'phone',
        'email',
        'website',
        'social_links',
        'meta_title',
        'meta_description',
        'logo_path',
        'hero_image',
        'is_active',
    ];

    protected $casts = [
        'social_links' => 'array',
        'values' => 'array',
        'founded_year' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get artisans associated with this brand
     */
    public function artisans(): HasMany
    {
        return $this->hasMany(Artisan::class);
    }

    /**
     * Get featured artisans
     */
    public function featuredArtisans(): HasMany
    {
        return $this->artisans()->where('is_featured', true)->orderBy('display_order');
    }

    /**
     * Get materials used by this brand
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    /**
     * Get featured materials
     */
    public function featuredMaterials(): HasMany
    {
        return $this->materials()->where('is_featured', true);
    }

    /**
     * Scope: Get active brands
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
