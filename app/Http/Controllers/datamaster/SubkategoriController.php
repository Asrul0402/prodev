<?php

namespace App\Http\Controllers\datamaster;

use App\master\Subkategori;
use App\master\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class SubkategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subkategoris = Subkategori::all();
        $kategoris = Kategori::all();

        return view('datamaster.subkategori')->with([
            'subkategoris' => $subkategoris,
            'kategoris' =>$kategoris
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
        $subkategori = new Subkategori;
        $subkategori->subkategori = $request->subkategori;
        $subkategori->kategori_id = $request->kategori;
        $subkategori->pembulatan = $request->pembulatan;
        $subkategori->save();

        return Redirect::back()->with('status','Subkategori '.$subkategori->subkategori.' Berhasil Dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\master\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Subkategori $subkategori)
    {
        $kategoris = Kategori::all();
        return view('datamaster.editsubkategori')->with([
            'subkategori'=> $subkategori,
            'kategoris' =>$kategoris
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\master\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subkategori $subkategori)
    {
        $subkategori->subkategori = $request->subkategori;
        $subkategori->kategori_id = $request->kategori;
        $subkategori->pembulatan = $request->pembulatan;
        $subkategori->save();

        return Redirect()->route('subkategori.index')->with('status','Subkategori '.$subkategori->subkategori.' Telah DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\master\Subkategori  $subkategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subkategori $subkategori)
    {
        $subkategori->delete();
        return Redirect::back()->with('error','Subkategori '.$subkategori->subkategori.' Berhasil Dihapus !');

    }
}
