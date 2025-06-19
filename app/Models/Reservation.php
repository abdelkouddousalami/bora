<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;    protected $fillable = [
        'user_id',
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
        'date' => 'date'
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_COLORS = [
        self::STATUS_PENDING => 'warning',
        self::STATUS_CONFIRMED => 'success',
        self::STATUS_CANCELLED => 'danger',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusColorAttribute()
    {
        return self::STATUS_COLORS[$this->status] ?? 'secondary';
    }

    public function getStatusBadgeClassAttribute()
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
