<?php


use App\CurrencyApi\CbrCurrencyApi;
use App\CurrencyApi\Exceptions\CurrencyApiException;
use App\CurrencyApi\Models\CurrencyCollectionData;
use App\CurrencyApi\Models\CurrencyData;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class CurrencyApiTest extends TestCase
{
    public CbrCurrencyApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . '/../Stubs/valute.json')),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $this->api = new CbrCurrencyApi($client);
    }


    public function testCanGetCurrencies()
    {
        $currencies = $this->api->currencies();
        $this->assertTrue($currencies instanceof CurrencyCollectionData);
        $this->assertCount(4, $currencies);
    }

    public function testCanFilterCurrencies()
    {
        $char_code = 'AUD';
        $currencies = $this->api->currencies([$char_code]);
        $this->assertTrue($currencies instanceof CurrencyCollectionData);
        $this->assertCount(1, $currencies);
        $this->assertSame($char_code, $currencies[0]->char_code);
    }

    public function testCanGetCurrency()
    {
        $char_code = 'AUD';
        $currency =$this->api->currency($char_code);
        $this->assertTrue($currency instanceof CurrencyData);
        $this->assertSame($char_code, $currency->char_code);
    }

    public function testGetNonExistCurrency()
    {
        $this->expectException(CurrencyApiException::class);
        $this->api->currency('NON_EXISTS');
    }
}
