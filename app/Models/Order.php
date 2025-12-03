<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
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
        $this->order_number = $prefix . '-' . strtoupper(substr(md5(rand()), 0, 6));
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