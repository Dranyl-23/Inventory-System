<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Categories extends Model
{
    //
    use HasUuids;
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    public function items() {
          return $this->hasMany(Item::class, 'category_id');
    }
    
}
