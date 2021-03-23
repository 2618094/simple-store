<?php

namespace App\Models\Currency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'char_code',
        'name',
        'rate',
    ];

    public function history()
    {
        return $this->hasMany(CurrencyHistory::class, 'char_code', 'char_code');
    }
}
