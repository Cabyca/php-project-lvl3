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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::select('select * from urls');
        foreach($users as $user) {
            var_dump($user);
        }
        echo "Превед медвед";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return redirect()->route('urls.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        print_r($url = $request->input('url.name'));
        echo "----------/n";

        echo "Это метод store";
        $request->validate([
            'url.name' => 'required|max:255'
        ]);

        $date = Carbon::now();

        DB::table('urls')->insert(['name' => $url, 'created_at' => $date]);

        return redirect('/')->with('success','Post created successfully.');
    }

    //public function store(Request $request)
    //{
    //    $request->validate([
    //        'title' => 'required',
    //        'description' => 'required',
    //    ]);
//
     //   Post::create($request->all());
//
     //   return redirect()->route('posts.index')->with('success','Post created successfully.');
    //}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
