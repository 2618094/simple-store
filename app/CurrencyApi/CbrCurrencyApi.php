<?php


namespace App\CurrencyApi;


use App\CurrencyApi\Exceptions\CurrencyApiException;
use App\CurrencyApi\Models\CurrencyCollectionData;
use App\CurrencyApi\Models\CurrencyData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Validator;

class CbrCurrencyApi implements CurrencyApi
{
    const CURRENCY_URL = 'https://www.cbr-xml-daily.ru/daily_json.js';

    public function __construct(
        private Client $client,
    ){}

    /**
     * @param array $char_codes
     * @return CurrencyCollectionData
     * @throws CurrencyApiException
     */
    public function currencies(array $char_codes = []): CurrencyCollectionData
    {
        $currencies = $this->filter($char_codes, $this->fetch());
        return CurrencyCollectionData::create($currencies);
    }

    /**
     * @param string $char_code
     * @return CurrencyData
     * @throws CurrencyApiException
     */
    public function currency(string $char_code): CurrencyData
    {
        $currencies = $this->filter([$char_code], $this->fetch());
        if(count($currencies) !== 1){
            throw new CurrencyApiException("Char code {$char_code} not found");
        }
        return new CurrencyData($currencies[0]);
    }

    private function filter(array $char_codes, array $data): array
    {
        return $char_codes ? collect($data)->filter(function ($valute) use ($char_codes){
            return in_array($valute['char_code'], $char_codes);
        })->toArray() : $data;
    }

    /**
     * @return array
     * @throws CurrencyApiException
     */

    private function fetch(): array
    {
        try{
            $response = $this->client->get(self::CURRENCY_URL);
        }catch (GuzzleException $exception){
            throw new CurrencyApiException($exception->getMessage(), $exception->getCode(), $exception);
        }
        return $this->parse($response->getBody()->getContents());
    }

    /**
     * @param string $json
     * @return array
     * @throws CurrencyApiException
     */
    private function parse(string $json): array
    {
        $data = json_decode($json, true);
        if(! json_last_error() === JSON_ERROR_NONE){
            throw new CurrencyApiException(json_last_error_msg());
        }
        $this->validate($data);

        $currencies = [];
        foreach ($data['Valute'] as $currency){
            $currencies[] = [
                'id' => $currency['ID'],
                'num_code' => $currency['NumCode'],
                'char_code' => $currency['CharCode'],
                'nominal' => $currency['Nominal'],
                'name' => $currency['Name'],
                'rate' => $currency['Value'],
            ];
        }
        return $currencies;
    }

    /**
     * @param array $data
     * @throws CurrencyApiException
     */
    private function validate(array $data): void
    {
        $validator = Validator::make($data, [
            'Valute.*.ID' => 'required | string',
            'Valute.*.NumCode' => 'required | string',
            'Valute.*.CharCode' => 'required | string',
            'Valute.*.Nominal' => 'required | numeric',
            'Valute.*.Name' => 'required | string',
            'Valute.*.Value' => 'required | numeric'
        ]);
        if($validator->fails()){
            throw new CurrencyApiException('Fail to validate api data: ' . $validator->errors()->toJson());
        }
    }
}
