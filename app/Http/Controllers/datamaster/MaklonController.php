<?php

namespace App\Http\Controllers\datamaster;

use App\master\Maklon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class MaklonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maklons = Maklon::all();
        return view('datamaster.maklon')->with([
            'maklons' => $maklons
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
        $maklon = new Maklon;
        $maklon->maklon = $request->maklon;
        $maklon->keterangan = $request->keterangan;
        $maklon->save();

        return Redirect::back()->with('status','Maklon '.$maklon->maklon.' Telah Dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\master\Maklon  $maklon
     * @return \Illuminate\Http\Response
     */
    public function edit(Maklon $maklon)
    {
        return view('datamaster.editmaklon')->with([
            'maklon'=> $maklon
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\master\Maklon  $maklon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maklon $maklon)
    {
        $maklon->maklon = $request->maklon;
        $maklon->keterangan = $request->keterangan;
        $maklon->save();

        return Redirect()->route('maklon.index')->with('status','Maklon '.$maklon->maklon.' Telah DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\master\Maklon  $maklon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maklon $maklon)
    {
        $maklon->delete();

        return Redirect::back()->with('error','Maklon '.$maklon->maklon.' Berhasil Dihapus !');

    }
}
