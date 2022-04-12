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

        /* @var $this->id */
        $this->id = DB::table('urls')
            ->insertGetId(['name' => 'https://www.yandex.ru', 'created_at' => Carbon::now()]);
    }

    public function testStore()
    {
        $testHtml = file_get_contents(implode(DIRECTORY_SEPARATOR, [__DIR__, '..', "Fixtures", 'test.html']));

        Http::fake(['https://www.yandex.ru' => Http::response($testHtml, 200)]);

        $expectedData = [
            'h1' => 'Проанализировать страницу',
            'title' => 'Анализатор страниц',
            'description' => 'Description',
            'url_id' => $this->id,
            'status_code' => 200
        ];

        $url = DB::table('urls')->first();
        $response = $this->post(route('checks.store', $url->id));
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('url_checks', $expectedData);
    }
}
