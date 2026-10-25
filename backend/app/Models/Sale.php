<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Sale extends Model
{
    use HasUuids;

    protected $fillable = [
        'item_id',
        'user_id',
        'customer_id',
        'amount',
        'discount',
        'quantity',
        'price',
    ];

    public function saleSummaries() {
        return $this->hasMany(Sale_Summaries::class, 'sale_id');
    }

    public function item() {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
