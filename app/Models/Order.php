<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'total_amount',
        'payment_status',
        'midtrans_transaction_id',
        'payment_method',
        'notes'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateOrderNumber()
    {
        $prefix = 'ORD-' . date('YmdHis');
        $this->order_number = $prefix . '-' . Str::upper(Str::random(6));
        return $this->order_number;
    }

    public function isPending()
    {
        return $this->payment_status === 'pending';
    }

    public function isCompleted()
    {
        return $this->payment_status === 'completed';
    }

    public function isFailed()
    {
        return $this->payment_status === 'failed';
    }
}