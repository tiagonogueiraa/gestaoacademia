<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'status',
        'street',
        'number',
        'district',
        'city',
        'state',
        'zip_code',
        'plan_value',
    ];
}
