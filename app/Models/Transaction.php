<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'customer_id',
        'product_id',
        'qty',
        'total_price',
        'input_by'
    ];
}
