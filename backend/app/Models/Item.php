<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Item extends Model
{

    use HasUuids;
    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'price',
    ];

    public function category() {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function stocks() {
        return $this->hasMany(Stocks::class, 'item_id');
    }

    public function sales() {
        return $this->hasMany(Sale::class, 'item_id');
    }
}
