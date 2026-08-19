<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MasterLog extends Model
{
    protected $table = 'master_logs';

    protected $fillable = [
        'actor_type',
        'actor_id',
        'actor_name',
        'actor_role',
        'source',
        'action',
        'module',
        'description',
        'method',
        'route_name',
        'url',
        'ip_address',
        'user_agent',
        'response_status',
        'request_data',
        'properties',
    ];

    protected $casts = [
        'request_data' => 'array',
        'properties' => 'array',
        'response_status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        if (! empty($filters['q'])) {
            $term = trim((string) $filters['q']);
            $query->where(function (Builder $q) use ($term) {
                $q->where('description', 'like', "%{$term}%")
                    ->orWhere('actor_name', 'like', "%{$term}%")
                    ->orWhere('module', 'like', "%{$term}%")
                    ->orWhere('action', 'like', "%{$term}%")
                    ->orWhere('url', 'like', "%{$term}%")
                    ->orWhere('route_name', 'like', "%{$term}%")
                    ->orWhere('ip_address', 'like', "%{$term}%");
            });
        }

        if (! empty($filters['source'])) {
            $query->where('source', $filters['source']);
        }

        if (! empty($filters['actor_type'])) {
            $query->where('actor_type', $filters['actor_type']);
        }

        if (! empty($filters['action'])) {
            $query->where('action', $filters['action']);
        }

        if (! empty($filters['module'])) {
            $query->where('module', $filters['module']);
        }

        if (! empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (! empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $query;
    }

    public function sourceBadgeClass(): string
    {
        return match ($this->source) {
            'admin_panel' => 'bg-primary',
            'frontend' => 'bg-success',
            'mobile_app' => 'bg-info text-dark',
            'api' => 'bg-warning text-dark',
            'system' => 'bg-secondary',
            default => 'bg-secondary',
        };
    }

    public function actorBadgeClass(): string
    {
        return match ($this->actor_type) {
            'admin' => 'bg-dark',
            'user' => 'bg-teal',
            'guest' => 'bg-secondary',
            'system' => 'bg-light text-dark border',
            default => 'bg-secondary',
        };
    }
}
