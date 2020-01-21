<?php

namespace App\Http\Controllers\datamaster;

use App\master\Satuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuans = Satuan::all();
        return view('datamaster.satuan')->with([
            'satuans' => $satuans
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
        $satuan = new Satuan;
        $satuan->satuan = $request->satuan;
        $satuan->save();

        return Redirect::back()->with('status','Satuan '.$satuan->satuan.' Berhasil Dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\master\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Satuan $satuan)
    {
        return view('datamaster.editsatuan')->with([
            'satuan' => $satuan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\master\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        $satuan->satuan = $request->satuan;
        $satuan->save();

        return Redirect()->route('satuan.index')->with('status','Satuan '.$satuan->satuan.' Berhasil DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\master\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satuan $satuan)
    {
        $satuan->delete();

        return Redirect::back()->with('error','Satuan '.$satuan->satuan.' Telah Dihapus !');

    }
}
