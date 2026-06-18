<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Material Model
 * 
 * Represents a material used in shoe production.
 * Stores sourcing story, sustainability info, and care instructions.
 */
class Material extends Model
{
    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'category',
        'color',
        'description',
        'properties',
        'care_instructions',
        'origin',
        'supplier_name',
        'supplier_story',
        'supplier_country',
        'is_sustainable',
        'is_organic',
        'is_locally_sourced',
        'sustainability_note',
        'ethical_statement',
        'durability_rating',
        'eco_rating',
        'longevity_story',
        'image',
        'icon',
        'products_using_this',
        'is_featured',
    ];

    protected $casts = [
        'products_using_this' => 'array',
        'is_sustainable' => 'boolean',
        'is_organic' => 'boolean',
        'is_locally_sourced' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the brand that owns this material
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Scope: Get featured materials
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: Get sustainable materials
     */
    public function scopeSustainable($query)
    {
        return $query->where('is_sustainable', true);
    }

    /**
     * Scope: Get materials by category
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get eco badge (visual indicator)
     */
    public function getEcoBadge(): array
    {
        return [
            'rating' => $this->eco_rating ?? 'N/A',
            'sustainable' => $this->is_sustainable,
            'organic' => $this->is_organic,
            'local' => $this->is_locally_sourced,
            'icon' => match ($this->eco_rating) {
                'A+' => '♻️ Premium Eco',
                'A' => '🌱 Eco-Friendly',
                'B' => '🌍 Moderate',
                default => 'Standard'
            }
        ];
    }

    /**
     * Get durability emoji
     */
    public function getDurabilityIcon(): string
    {
        return match ($this->durability_rating) {
            'Excellent' => '⭐⭐⭐⭐⭐',
            'Very Good' => '⭐⭐⭐⭐',
            'Good' => '⭐⭐⭐',
            default => '⭐⭐'
        };
    }
}
