<?php

namespace App\CurrencyApi\Models;

use Spatie\DataTransferObject\DataTransferObject;

class CurrencyData extends DataTransferObject
{
    public string $id;
    public string $num_code;
    public string $char_code;
    public int $nominal;
    public string $name;
    public float $rate;
}
