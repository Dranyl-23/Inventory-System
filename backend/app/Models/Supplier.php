<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Supplier extends Model
{
    use HasUuids;
    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'owner_name',
        'address',
        'phone',
        'email',
    ];

    public function stocks() {
        return $this->hasMany(Stocks::class, 'supplier_id');
    }
}
