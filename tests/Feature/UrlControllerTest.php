<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

class UrlControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        DB::table('urls')->insert(['name' => 'https://www.yandex.ru', 'created_at' => Carbon::now()]);
        DB::table('urls')->insert(['name' => 'https://www.mail.ru', 'created_at' => Carbon::now()]);
        DB::table('urls')->insert(['name' => 'https://www.google.com', 'created_at' => Carbon::now()]);
    }

    public function testAssertDatabaseHas(): void
    {
        $this->assertDatabaseHas('urls', ['name' => 'https://www.yandex.ru']);
        $this->assertDatabaseHas('urls', ['name' => 'https://www.mail.ru']);
        $this->assertDatabaseHas('urls', ['name' => 'https://www.google.com']);
    }

    public function testAssertDatabaseCount()
    {
        $this->assertDatabaseCount('urls', 3);
    }

    public function testBasicRequest()
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    public function testUrlsRequest()
    {
        $response = $this->get('/urls');

        $response->assertOk();
    }

    public function testUrlssRequest()
    {
        $response = $this->get('/urlss');

        $response->assertNotFound();
    }

    public function testIndex()
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
        $namesUrl = DB::table('urls')->pluck('name')->toArray();
        $response->assertViewIs('urls.index');
    }

    public function testStoreValid()
    {
        $dataCorrectNoExistsToBase = ['url' => ['name' => "https://www.PrevedMedved.ru"]];
        $response = $this->post(route('urls.store'), $dataCorrectNoExistsToBase);
        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', ['name' => 'https://www.PrevedMedved.ru']);
    }

    public function testStoreNoValid()
    {
        $dataInCorrect = ['url' => ['name' => "yandex"]];
        $response = $this->post(route('urls.store'), $dataInCorrect);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('urls', ['name' => "yandex"]);
    }

    public function testStoreValidExistsToDataBase()
    {
        $id = DB::table('urls')->where('name', 'https://www.yandex.ru')->value('id');
        $response = $this->post(route('urls.store'), ['url' => ['name' => "https://www.yandex.ru"]]);
        $response->assertRedirect(route('urls.show', ['url' => $id]));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', ['name' => 'https://www.yandex.ru']);
    }

    public function testShow()
    {
        $id = DB::table('urls')->where('id', 1)->value('id');
        $response = $this->get(route('urls.show', $id));
        $response->assertOk();
        $nameUrl = DB::table('urls')->find($id)->name;
        $response->assertSee($nameUrl);
        $response->assertViewIs('urls.show');
    }
}
