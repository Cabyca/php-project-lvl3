<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlCheckController;
use Illuminate\Support\Facades\Http;

class UrlCheckControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $created_atForYandex = Carbon::now();
        $created_atForMail = Carbon::now();
        $created_atForGoogle = Carbon::now();

        DB::table('urls')->insert(['name' => 'https://www.yandex.ru', 'created_at' => $created_atForYandex]);
        DB::table('url_checks')->insert(['url_id' => '1', 'status_code' => 200, 'created_at' => $created_atForYandex]);
    }

    public function testStore()
    {
        Http::fake([
            // Заглушка JSON ответа для адреса yandex.ru ...
            'https://www.yandex.ru' => Http::response(['foo' => 'bar'], 200),

        ]);

        $url = DB::table('urls')->first();
        $response = $this->post(route('checks.store', $url->id));
        $response->assertStatus(302);
        ;

        $this->assertDatabaseHas('url_checks', ['url_id' => $url->id, 'status_code' => 200]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
