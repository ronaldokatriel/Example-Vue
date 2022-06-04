<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid','name','email','number','address','transaction_total','transaction_status'
    ];
}
