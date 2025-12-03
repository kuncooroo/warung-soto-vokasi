<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentHistory extends Model
{
    protected $fillable = ['order_id', 'transaction_id', 'payment_method', 'status', 'amount', 'metadata'];
    protected $casts = ['metadata' => 'json'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}