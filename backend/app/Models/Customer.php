<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Customer extends Model
{
    //
    use HasUuids;

    protected $table = 'customers';

    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'birthdate',
        'age',
        'gender',
    ];

    public function sales() {
        return $this->hasMany(Sale::class, 'customer_id');
    }

    public function saleSummaries() {
        return $this->hasMany(Sale_Summaries::class, 'customer_id'); 
    }
}
