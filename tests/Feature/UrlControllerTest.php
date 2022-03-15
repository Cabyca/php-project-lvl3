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
    }

    public function testAssertDatabaseCount()
    {
        $this->assertDatabaseCount('urls', 3);
    }

    public function test_a_basic_request()
    {
        $response = $this->get('/');

        $response->assertOk();;
    }

    public function test_a_urls_request()
    {
        $response = $this->get('/urls');

        $response->assertOk();;
    }

    public function test_a_urlss_request()
    {
        $response = $this->get('/urlss');

        $response->assertNotFound();;
    }

    public function testIndex()
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
        $namesUrl = DB::table('urls')->pluck('name')->toArray();
        $response->assertSeeInOrder($namesUrl);
        $response->assertViewIs('urls.index');
    }

    public function testStore()
    {
        $dataCorrectNoExistsToBase = ['url' => ['name' => "https://www.PrevedMedved.ru"]];
        $response = $this->post(route('urls.store'), $dataCorrectNoExistsToBase);
        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
        //сделать на наличие в базе
        //$response = ass

        $dataCorrectExistsToBase = ['url' => ['name' => "https://www.yandex.ru"]];
        $id = DB::table('urls')->where('name', $dataCorrectExistsToBase['url']['name'])->value('id');
        $response = $this->post(route('urls.store'), $dataCorrectExistsToBase);
        $response->assertRedirect(route('urls.show', ['url' => $id]));
        $response->assertSessionHasNoErrors();

        $dataInCorrect = ['url' => ['name' => "yandex"]];
        $response = $this->post(route('urls.store'), $dataInCorrect);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors();
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
