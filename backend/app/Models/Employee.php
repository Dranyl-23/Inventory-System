<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Employee extends Model
{
    //
    use HasUuids;

    protected $table = 'employees';

    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'position',
        'birthdate',
        'age',
        'civil_status',
        'gender',
    ];

    public function saleSummaries() {
        return $this->hasMany(Sale_Summaries::class, 'employee_id');
    }
}

