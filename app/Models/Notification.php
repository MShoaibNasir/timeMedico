<?php

namespace App\Models;

use App\Models\Concerns\HidesTemporaryOrderNo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HidesTemporaryOrderNo;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'any_relivent_message',
        'message',
        'image',
        'action_type',
        'action_id',
        'is_read',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'action_id');
    }

    public function markAsRead(): void
    {
        if (! $this->is_read) {
            $this->forceFill(['is_read' => true])->save();
        }
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
