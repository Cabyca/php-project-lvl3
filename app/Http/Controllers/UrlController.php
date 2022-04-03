<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        $urls = DB::table('urls')
            ->orderBy('id')
            ->simplePaginate(50);

        $urlsChecks = DB::table('url_checks')
            ->get()->keyBy('url_id');

        return view('urls.index', [
            'urls' => $urls,
            'urlsChecks' => $urlsChecks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $url = $request->input('url.name');
        $request->validate([
            "url.name" => ["required","max:255","url"]
        ]);

        $parseUrl = parse_url($url);
        $urlToDatabase = $parseUrl['scheme'] . "://" . $parseUrl['host'];

        $checkId = DB::table('urls')->where('name', $urlToDatabase)->value('id');

        if ($checkId) {
            flash('Страница уже существует')->success();
            return redirect()->route('urls.show', ['url' => $checkId]);
        }

        $date = Carbon::now();

        DB::table('urls')->insert(['name' => $urlToDatabase, 'created_at' => $date]);
        $id = DB::table('urls')->where('name', $urlToDatabase)->value('id');

        flash('Url успешно добавлен')->success();
        return redirect()->route('urls.show', ['url' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id): \Illuminate\Contracts\View\View
    {
        $url = DB::table('urls')->find($id);
        $checksSite = DB::table('url_checks')
            ->latest()
            ->where('url_id', $id)
            ->simplePaginate(15);
        return view('urls.show', compact('url', 'checksSite'));
    }
}
