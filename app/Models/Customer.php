<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'mothers_maiden_name',
        'dob',
        'address',
        'phone_number',
        'national_id',
        'occupation',
    ];

    protected $casts = [
        'dob' => 'date',
    ];
}
