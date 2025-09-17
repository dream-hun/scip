<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = [];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class);
    }

    public function cooperative(): BelongsTo
    {
        return $this->belongsTo(Cooperative::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

}
