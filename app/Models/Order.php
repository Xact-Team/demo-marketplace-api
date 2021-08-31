<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'nft_id',
        'buyer_id',
        'transaction_id',
        'confirmed_at'
    ];

    public function nft(): BelongsTo
    {
        return $this->belongsTo(Nft::class);
    }
}
