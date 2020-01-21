<?php

namespace App\Http\Controllers\datamaster;

use App\master\Produksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produksis = Produksi::all();
        return view('datamaster.produksi')->with([
            'produksis' => $produksis
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
        $produksi = new Produksi;
        $produksi->produksi = $request->Produksi;
        $produksi->keterangan = $request->Keterangan;
        $produksi->save();

        return Redirect::back()->with('status','Produksi '.$produksi->produksi.' Berhasil Dibuat');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\master\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Produksi $produksi)
    {
        return view('datamaster.editproduksi')->with([
            'produksi' => $produksi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\master\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produksi $produksi)
    {
        $produksi->produksi = $request->Produksi;
        $produksi->keterangan = $request->Keterangan;
        $produksi->save();

        return Redirect()->route('produksi.index')->with('status','Produksi '.$produksi->produksi.' Berhasil DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\master\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produksi $produksi)
    {
        $produksi->delete();
        return Redirect::back()->with('error','Produksi '.$produksi->produksi.' Berhasil Dihapus');

    }
}
