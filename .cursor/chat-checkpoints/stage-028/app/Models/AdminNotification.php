<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminNotification extends Model
{
    protected $table = 'admin_notifications';

    protected $fillable = [
        'admin_id',
        'type',
        'title',
        'message',
        'severity',
        'action_type',
        'action_id',
        'action_url',
        'data',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function markAsRead(): void
    {
        if (! $this->is_read) {
            $this->forceFill([
                'is_read' => true,
                'read_at' => now(),
            ])->save();
        }
    }

    public function typeBadgeClass(): string
    {
        return match ($this->type) {
            'new_order' => 'bg-primary',
            'payment_slip' => 'bg-warning text-dark',
            'feedback' => 'bg-info text-dark',
            'low_stock' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    public function priorityBadgeClass(): string
    {
        return match ($this->severity) {
            'high' => 'bg-danger',
            'low' => 'bg-secondary',
            default => 'bg-success',
        };
    }
}
