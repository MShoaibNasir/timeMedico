<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;


    protected $table = 'orders';
    protected $guarded = ['id'];

    /** Main fulfilment path — later steps cannot go back. */
    public const STATUS_FLOW = [
        'Pending' => 1,
        'Processing' => 2,
        'On The way' => 3,
        'Delivered' => 4,
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
      public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function isTerminalStatus(): bool
    {
        return in_array($this->status, ['Rejected', 'Returned'], true);
    }

    /**
     * Statuses the admin may select from the current status (no backward moves).
     */
    public function allowedStatuses(): array
    {
        if ($this->isTerminalStatus()) {
            return [$this->status];
        }

        $currentRank = self::STATUS_FLOW[$this->status] ?? 0;
        $allowed = [];

        foreach (self::STATUS_FLOW as $status => $rank) {
            if ($rank >= $currentRank) {
                $allowed[] = $status;
            }
        }

        if ($currentRank < (self::STATUS_FLOW['Delivered'] ?? 4)) {
            $allowed[] = 'Rejected';
        }

        if ($this->status === 'Delivered') {
            $allowed[] = 'Returned';
        }

        return $allowed;
    }

    public function canTransitionTo(string $newStatus): bool
    {
        return in_array($newStatus, $this->allowedStatuses(), true);
    }

    public static function isTemporaryNumber(?string $orderNo): bool
    {
        return is_string($orderNo) && str_starts_with($orderNo, 'TEMP-');
    }

    public function customerOrderNo(): string
    {
        $no = (string) ($this->order_no ?? '');
        if ($no !== '' && ! self::isTemporaryNumber($no)) {
            return ltrim($no, '#');
        }

        return (string) (100000000 + $this->id);
    }
}
