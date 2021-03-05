<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name',
        'client_address'
    ];

    public function getTotalValueAttribute()
    {
        return $this->total_product_value + $this->total_shipping_value;
    }
}
