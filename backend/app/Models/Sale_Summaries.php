<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Sale_Summaries extends Model
{

    use HasUuids;
    protected $table = 'sale__summaries';
    
    protected $fillable = [
        'sale_id',
        'customer_id',
        'employee_id',
        'amount',
        'discount',
    ];

    public function sale() {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
