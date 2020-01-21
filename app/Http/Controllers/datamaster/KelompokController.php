<?php

namespace App\Http\Controllers\datamaster;

use App\master\Kelompok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelompoks = Kelompok::all();
        return view('datamaster.kelompok')->with([
            'kelompoks' => $kelompoks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelompok = new Kelompok;
        $kelompok->nama = $request->kelompok;
        $kelompok->save();

        return Redirect::back()->with('status','Kelompok '.$kelompok->nama.' Berhasil Dibuat !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\master\Kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelompok $kelompok)
    {
        return view('datamaster.editkelompok')->with([
            'kelompok' => $kelompok
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\master\Kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelompok $kelompok)
    {
        $kelompok->nama = $request->kelompok;
        $kelompok->save();

        return Redirect()->route('kelompok.index')->with('status','Kelompok '.$kelompok->nama.' Berhasil DiUpdate !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\master\Kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelompok $kelompok)
    {
        $kelompok->delete();
        return Redirect::back()->with('error','Kelompok '.$kelompok->nama.' Berhasil Dihapus');
    }
}
