<?php

namespace App\Http\Controllers\datamaster;

use App\master\Tarkon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class TarkonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarkons = Tarkon::all();
        return view('datamaster.tarkon')->with([
            'tarkons' => $tarkons
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
        $tarkon = new Tarkon;
        $tarkon->tarkon = $request->tarkon;
        $tarkon->dari = $request->dari;
        $tarkon->sampai = $request->sampai;
        $tarkon->save();

        return Redirect::back()->with('status','Target Konsumen '.$tarkon->tarkon.' Berhasil Dibuat !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\master\Tarkon  $tarkon
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarkon $tarkon)
    {
        return view('datamaster.edittarkon')->with([
            'tarkon' => $tarkon
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\master\Tarkon  $tarkon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarkon $tarkon)
    {
        $tarkon->tarkon = $request->tarkon;
        $tarkon->dari = $request->dari;
        $tarkon->sampai = $request->sampai;
        $tarkon->save();

        return Redirect()->route('tarkon.index')->with('status','Target Konsumen '.$tarkon->tarkon.' Berhasil Diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\master\Tarkon  $tarkon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarkon $tarkon)
    {
        $tarkon->delete();
        return Redirect::back()->with('error','Target Konsumen '.$tarkon->tarkon.' Telah Dihapus !');

    }
}
