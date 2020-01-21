<?php

namespace App\Http\Controllers\datamaster;

use App\master\Curren;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class CurrensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currens = Curren::all();
        return view('datamaster.curren')->with([
            'currens' => $currens
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
        $curren = new Curren;
        $curren->currency = $request->currency;
        $curren->harga = $request->harga;
        $curren->keterangan = $request->keterangan;
        $curren->save();

        return Redirect::back()->with('status','Currency '.$curren->currency.' Berhasil Dibuat');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\master\Curren  $curren
     * @return \Illuminate\Http\Response
     */
    public function edit(Curren $curren)
    {
        return view('datamaster.editcurren')->with([
            'curren' => $curren
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\master\Curren  $curren
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curren $curren)
    {
        $curren->currency = $request->currency;
        $curren->harga = $request->harga;
        $curren->keterangan = $request->keterangan;
        $curren->save();

        return Redirect()->route('curren.index')->with('status','Currency '.$curren->currency.' Berhasil DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\master\Curren  $curren
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curren $curren)
    {
        $curren->delete();

        return Redirect::back()->with('error','Currency '.$curren->currency.' Berhasil Dihapus');
    }
}
