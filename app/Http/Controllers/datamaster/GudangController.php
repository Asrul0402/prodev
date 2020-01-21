<?php

namespace App\Http\Controllers\datamaster;

use App\master\Gudang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gudangs = Gudang::all();
        return view('datamaster.gudang')->with([
            'gudangs' => $gudangs
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
        $gudang = new Gudang;
        $gudang->gudang = $request->gudang;
        $gudang->keterangan = $request->keterangan;
        $gudang->save();

        return Redirect::back()->with('status','Gudang '.$gudang->gudang.' Berhasil Dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\master\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function edit(Gudang $gudang)
    {
        return view('datamaster.editgudang')->with([
            'gudang' => $gudang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\master\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gudang $gudang)
    {
        $gudang->gudang = $request->gudang;
        $gudang->keterangan = $request->keterangan;
        $gudang->save();

        return Redirect()->route('gudang.index')->with('status','Gudang '.$gudang->gudang.' Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\master\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gudang $gudang)
    {
        $gudang->delete();

        return Redirect::back()->with('error','Gudang '.$gudang->gudang.' Berhasil Dihapus !');
    }
}
