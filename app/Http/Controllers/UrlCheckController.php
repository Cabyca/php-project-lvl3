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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $date = Carbon::now();
        DB::table('url_checks')->insert(['url_id' => $id, 'created_at' => $date]);

        //Выведите идентификаторы и даты всех проверок на странице сайта.
        $checksSite = DB::table('url_checks')
            ->latest()
            ->get()
            ->where('url_id', $id);

        $url = DB::table('urls')->find($id);

        return view('urls.show', compact('checksSite', 'url'));
    }
}
