<?php


namespace App\CurrencyApi;

use App\CurrencyApi\Exceptions\CurrencyApiException;
use App\CurrencyApi\Models\CurrencyCollectionData;
use App\CurrencyApi\Models\CurrencyData;

interface CurrencyApi
{
    /**
     * @param array $char_codes
     * @return CurrencyCollectionData
     * @throws CurrencyApiException
     */
    public function currencies(array $char_codes = []): CurrencyCollectionData;

    /**
     * @param string $char_code
     * @return CurrencyData
     * @throws CurrencyApiException
     */
    public function currency(string $char_code): CurrencyData;
}
