<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nft extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token_id',
        'name',
        'description',
        'price',
        'currency',
        'supply',
        'fil_address',
        'network',
        'asset',
        'asset_type'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
