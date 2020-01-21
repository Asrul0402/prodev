<?php

namespace App\Http\Controllers\datamaster;

use App\master\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('datamaster.kategori')->with([
            'kategoris' => $kategoris
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
        $kategori = new Kategori;
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return Redirect::back()->with('status','Kategori '.$kategori->kategori.' Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\master\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('datamaster.editkategori')->with([
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\master\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return Redirect()->route('kategori.index')->with('status','Kategori '.$kategori->kategori.' Berhasil DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\master\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return Redirect::back()->with('error','Kategori '.$kategori->kategori.' Berhasil Dihapus');

    }
}
