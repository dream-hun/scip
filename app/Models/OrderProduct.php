<?php

namespace App\Models;

use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    protected $guarded=[];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getPriceAttribute(): Money
    {
        return Money::RWF($this->attributes['price']);
    }

    public function getTotalPriceAttribute(): Money
    {
        return Money::RWF($this->attributes['amount']);
    }
    public function getSubtotalAttribute(): Money
    {
        return Money::RWF(money_sum($this->attributes['amount']));
    }
}
