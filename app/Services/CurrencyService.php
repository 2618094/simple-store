<?php


namespace App\Services;


use App\CurrencyApi\CurrencyApi;
use App\CurrencyApi\Exceptions\CurrencyApiException;
use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyHistory;
use Illuminate\Support\Facades\DB;

class CurrencyService
{
    public function __construct(
        private CurrencyApi $currencyApi
    ){}

    public function update(?array $char_codes = []): int
    {
        $updated = 0;
        try {
            $currencies = $this->currencyApi->currencies($char_codes ?? []);
        } catch (CurrencyApiException $e) {
            report($e);
            return $updated;
        }

        DB::beginTransaction();
        foreach ($currencies as $currency){
            $updated++;
            Currency::query()->updateOrCreate(['char_code' => $currency->char_code], $currency->toArray());
            CurrencyHistory::query()->create($currency->toArray());
        }
        DB::commit();
        return $updated;
    }
}
