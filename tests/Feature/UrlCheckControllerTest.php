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

        $created_at = Carbon::now();

        DB::table('urls')->insert(['name' => 'https://www.yandex.ru', 'created_at' => $created_at]);
        DB::table('url_checks')->insert(['url_id' => '1', 'status_code' => 200, 'created_at' => $created_at]);
    }

    public function testStore()
    {
        Http::fake([
            // Заглушка JSON ответа для адреса yandex.ru ...
            'https://www.yandex.ru' => Http::response(['foo' => 'bar'], 200),

        ]);

        $url = DB::table('urls')->first();
        /** @var object $url */
        $response = $this->post(route('checks.store', $url->id));
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('url_checks', ['url_id' => $url->id, 'status_code' => 200]);
    }
}
