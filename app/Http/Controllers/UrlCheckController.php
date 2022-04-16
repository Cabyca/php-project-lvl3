<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DiDom\Document;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */
    public function store(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $url = DB::table('urls')->find($id)->name;

        abort_unless($url, 404);

        try {
            $response = Http::get($url);
            $status_code = $response->status();

            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $title = optional($document->first('title'))->text();
            $description = optional($document->first('meta[name=description]'))->getAttribute('content');

            DB::table('url_checks')->insert([
                'url_id' => $id,
                'status_code' => $status_code,
                'h1' => $h1,
                'title' => $title,
                'description' => $description,
                'created_at' => Carbon::now()]);

            flash('Страница успешно проверена')->success();
        } catch (HttpClientException | RequestException $e) {
            flash($e->getMessage())->error();
        }

        return redirect()->route('urls.show', [$id]);
    }
}
