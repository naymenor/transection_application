<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payemnt extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'transaction_id',
        'users_id',
        'transaction_ammount',
        'pay_status'
    ];
}
