<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */
    public function store(Request $request, $id)
    {
        $nameSite = DB::table('urls')->find($id)->name;
        $response = Http::get($nameSite);
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

        $checksSite = DB::table('url_checks')
            ->latest()
            ->where('url_id', $id)
            ->get();

        $url = DB::table('urls')->find($id);

        flash('Страница успешно проверена')->success();

        return view('urls.show', compact('checksSite', 'url'));
    }
}
