<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'fishing_tour_id',
        'name',
        'email',
        'phone',
        'tour_type',
        'date',
        'guests',
        'message',
        'status',
        'price'
    ];

    protected $casts = [
        'date' => 'datetime',
        'price' => 'decimal:2'
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at'
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_COLORS = [
        self::STATUS_PENDING => 'warning',
        self::STATUS_CONFIRMED => 'success',
        self::STATUS_CANCELLED => 'danger',
    ];

    /**
     * Get the reservation date formatted
     */
    public function getReservationDateAttribute()
    {
        return $this->date;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fishingTour(): BelongsTo
    {
        return $this->belongsTo(FishingTour::class);
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'secondary';
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return 'bg-' . $this->status_color;
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isConfirmed(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }
}
