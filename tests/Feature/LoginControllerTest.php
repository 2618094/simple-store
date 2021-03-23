<?php


class LoginControllerTest extends \Tests\TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DefaultUserSeeder::class);
    }

    public function testCanLogin()
    {
        $this->post(route('auth.login'), [
            'email' => config('auth.default_user.email'),
            'password' => config('auth.default_user.password'),
        ])->assertSuccessful()
            ->assertJsonStructure([
                'access_token',
                'token_type'
            ]);
    }

    public function testCanAuthorize()
    {
        $this->get(route('auth.me'), [
            'Authorization' => 'Bearer ' . $this->getToken()
        ])->assertSuccessful()
            ->assertJsonFragment([
                'email' => config('auth.default_user.email')
            ]);
    }

    private function getToken()
    {
        return $this->post(route('auth.login'), [
            'email' => config('auth.default_user.email'),
            'password' => config('auth.default_user.password'),
            ])->json('access_token');
    }

}
