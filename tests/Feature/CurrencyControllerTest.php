<?php


use App\Models\Currency\Currency;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{

    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(\App\Models\User::factory()->create());
    }

    public function testIndex()
    {
        Currency::factory(2)->create();
        $this->get(route('currencies.index'))
            ->assertSuccessful()
            ->assertJsonCount(2, 'data');
    }

    public function testShow()
    {
        $model = Currency::factory()->create();
        $this->get(route('currencies.show', $model->id))
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'id' => $model->id,
                    'char_code' => $model->char_code,
                    'name' => $model->name,
                    'rate' => $model->rate,
                ]
            ]);

    }


}
