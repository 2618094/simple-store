<?php

namespace App\CurrencyApi\Models;

use Spatie\DataTransferObject\DataTransferObjectCollection;

/**
 * @method CurrencyData current
 */

class CurrencyCollectionData extends DataTransferObjectCollection
{
    public static function create(array $data): self
    {
        return new static(CurrencyData::arrayOf($data));
    }
}
