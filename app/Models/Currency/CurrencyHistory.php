<?php

namespace App\Models\Currency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'char_code',
        'rate',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'char_code', 'char_code');
    }
}
