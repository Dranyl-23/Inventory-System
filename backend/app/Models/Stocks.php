<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Stocks extends Model
{
    use HasUuids;
    protected $table = 'stocks';

    protected $fillable = [
       'supplier_id',
       'item_id',
       'quantity'
    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function item() {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
