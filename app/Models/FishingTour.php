<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FishingTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'duration',
        'capacity',
        'price',
        'price_type',
        'image',
        'features',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function getFormattedPriceAttribute()
    {
        if (!$this->price) return null;
        
        return $this->price_type === 'per_person' 
            ? number_format($this->price, 2) . ' € / ' . __('tours.per_person')
            : number_format($this->price, 2) . ' €';
    }

    /**
     * Get all reservations for this tour
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'fishing_tour_id');
    }
}
