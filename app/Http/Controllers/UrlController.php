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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $urls = DB::table('urls')
            ->orderBy('id')->get();

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

        $id = DB::table('urls')->where('name', $urlToDatabase)->value('id');

        if ($id) {
            flash('Страница уже существует')->success();
            return redirect()->route('urls.show', ['url' => $id]);
        }

        $date = Carbon::now();

        DB::table('urls')->insert(['name' => $urlToDatabase, 'created_at' => $date]);

        flash('Url успешно добавлен')->success();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $url = DB::table('urls')->find($id);
        $checksSite = DB::table('url_checks')
            ->latest()
            ->where('url_id', $id)
            ->paginate(15);
        return view('urls.show', compact('url', 'checksSite'));
    }
}
