<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
