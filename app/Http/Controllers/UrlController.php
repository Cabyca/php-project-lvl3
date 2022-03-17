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
        //$lastCheckSite = DB::table('url_checks')->get()->where('created_at');

        $lastCheckSites = DB::table('urls')
            ->leftJoin('url_checks', 'urls.id', '=', 'url_checks.url_id')
            ->groupBy('url_checks.url_id')
            ->select('urls.id', 'url_checks.url_id', 'urls.name', 'url_checks.created_at');

        // а как увидеть этот запрос? и почему у меня получилось выводить последнюю дату проверки?

            //->where('url_checks.created_at')
            //->latest();
            //->get();

        return view('urls.index', [
            'lastCheckSites' => $lastCheckSites->simplePaginate(15)
        ]);

        //return view('urls.index', [
        //    'urls' => DB::table('urls')->simplePaginate(15)
        //]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
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
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = DB::table('urls')->find($id);
        $checksSite = DB::table('url_checks')
            ->latest()
            ->get()
            ->where('url_id', $id);
        return view('urls.show', compact('url', 'checksSite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
