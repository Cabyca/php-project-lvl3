<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        echo $id;
        dd("Превед медвед");



        $url = $request->input('url.name');

        $parseUrl = parse_url($url);
        $urlToDatabase = $parseUrl['scheme'] . "://" . $parseUrl['host'];

        $date = Carbon::now();

        DB::table('urls')->insert(['name' => $urlToDatabase, 'created_at' => $date]);

        flash('Url успешно добавлен')->success();

        return redirect('/');
    }
}
