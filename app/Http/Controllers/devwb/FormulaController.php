<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Workbook;
use App\dev\Formula;
use App\devnf\tb_vitmin;
use App\devnf\tb_amino_acid;
use App\nutfact\tb_ingredient;
use App\devnf\tb_analisa;
use App\devnf\tb_nutrition;
use App\nutfact\tb_parameter;
use App\dev\Fortail;
use App\dev\Premix;
use App\dev\Pretail;
use App\dev\Bahan;
use App\master\Curren;
use App\Pesan;
use Auth;
use Redirect;

class FormulaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk' || 'rule:kemas');
    }
    
    public function new(Request $request)
    {
        // Open Workbook
        $workbook = Workbook::where('id', $request->workbook_id)->first();
        // Target Serving
        $workbook->target_serving = $request->target_serving;
        $workbook->save();
        // New Formula        
        $formulas = new Formula;
        $formulas->workbook_id = $request->workbook_id;
        $formulas->kode_formula = $request->kode_formula;
        $formulas->nama_produk = $workbook->nama_project;
        $formulas->revisi = $workbook->revisi;
        $formulas->jenis = $workbook->jenis;
        $formulas->versi = 1;
        $formulas->subbrand_id = $workbook->subbrand_id;        
        $formulas->save();
        
        return redirect()->route('step1',$formulas->id)->with('status', 'Formula '.$formulas->nama_produk.' Telah Ditambahkan!');
    }

    // Hapus Formula-----------------------------------------------------------------------------------------------------    

    public function deleteformula($id){
            // find all & delete all
            $formula = Formula::where('id',$id)->first();
    
            // Delete Pesan
            $pesan = Pesan::where('formula_id',$id)->delete();
                $fortails = Fortail::where('formula_id',$formula->id)->get();
                foreach($fortails as $fortail){
                    $premixs = Premix::where('fortail_id',$fortail->id)->get();
                    foreach($premixs as $premix){
                        $pretails = Pretail::where('premix_id',$premix->id)->get();
                        foreach($pretails as $pretail){
                            $pretail->delete();
                        }
                    $premix->delete();
                    }
                $fortail->delete();
                }
            $formula->delete();
            
            return Redirect::back()->with('error', 'Formula Versi '.$formula->versi.'.'.$formula->turunan.' Telah Dihapus!');
        
    }

    // Detail Formula----------------------------------------------------------------------------------------------------

    public function detail($id){
        $data       = formula::with('Workbook')->where('id',$id)->get();
        $ing        = tb_nutrition::with('get_bahan','get_btp')->get();
        $tampilkan  = tb_parameter::with('get_akg')->offset(23)->limit(84)->get();
        
        //NUTFACT BAYANGAN
        $vit_a      = tb_vitmin::select('target')->where('parameter','12')->get();
        $thi        = tb_vitmin::select('target')->where('parameter','2')->get();
        $rib        = tb_vitmin::select('target')->where('parameter','10')->get();
        $nia        = tb_vitmin::select('target')->where('parameter','3')->get();
        $b5         = tb_vitmin::select('target')->where('parameter','20')->get();
        $pyr        = tb_vitmin::select('target')->where('parameter','21')->get();
        $b7         = tb_vitmin::select('target')->where('parameter','11')->get();
        $b12        = tb_vitmin::select('target')->where('parameter','60')->get();
        $asam       = tb_vitmin::select('target')->where('parameter','4')->get();
        $vit_c      = tb_vitmin::select('target')->where('parameter','61')->get();
        $vit_d      = tb_vitmin::select('target')->where('parameter','62')->get();
        $vit_e      = tb_vitmin::select('target')->where('parameter','14')->get();
        $mag        = tb_vitmin::select('target')->where('parameter','47')->get();
        $man        = tb_vitmin::select('target')->where('parameter','16')->get();
        $zin        = tb_vitmin::select('target')->where('parameter','48')->get();
        $lod        = tb_vitmin::select('target')->where('parameter','22')->get();
        $zat        = tb_vitmin::select('target')->where('parameter','45')->get();
        $sel        = tb_vitmin::select('target')->where('parameter','49')->get();
        $mol        = tb_vitmin::select('target')->where('parameter','69')->get();
        $ino        = tb_vitmin::select('target')->where('parameter','68')->get();
        
        $formula = Formula::where('id',$id)->first();
        $fortails = Fortail::where('formula_id',$formula->id)->get();
        $ada = Fortail::where('formula_id',$formula->id)->count();

        if($ada < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
        }elseif($formula->batch < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.'.'.$formula->turunan.' Belum Memliki Batch');
        }

        $detail_formula     = collect();
        $granulasi          = 0;
        $jumlah_granulasi   = 0;
        $biasa              = 0;
        $one_persen         = $formula->batch / 100;

        foreach($fortails as $fortail){
            // Get Persen
            $persen = $fortail->per_batch / $one_persen; $persen = round($persen, 2);
            $detail_formula->push([

                'id' => $fortail->id,
                'kode_komputer' => $fortail->kode_komputer,
                'nama_sederhana' => $fortail->nama_sederhana,
                'nama_bahan' => $fortail->nama_bahan,
                'per_batch' => $fortail->per_batch,
                'per_serving' => $fortail->per_serving,
                'granulasi' => $fortail->granulasi,
                'persen' => $persen,
            ]);            

            if($fortail->granulasi == 'ya'){
                $granulasi = $granulasi + 1;
                $jumlah_granulasi = $jumlah_granulasi + $fortail->per_batch;
            }
        }

        $biasa = $ada - $granulasi;
        $gp    = $jumlah_granulasi / $one_persen; $gp = round($gp , 2);

        // Tampil Harga Bahan Baku
        $detail_harga = collect();
        $satu_persen = $formula->serving / 100;
        // Inisialisasi Total
        $total_harga_per_gram = 0;
        $total_berat_per_serving = 0;
        $total_harga_per_serving = 0;
        $total_berat_per_batch = 0;
        $total_harga_per_batch = 0;
        $total_berat_per_kg = 0;
        $total_harga_per_kg = 0; 

        foreach($fortails as $fortail){
            //Get Needed
            $bahan  = Bahan::where('id',$fortail->bahan_id)->first();
            $curren = Curren::where('id',$bahan->curren_id)->first();
            //Start Count
                // Harga Pergram
                $hpg = ($bahan->harga_satuan * $curren->harga) / ($bahan->berat * 1000); $hpg = round($hpg,2);
                // PerServing
                $berat_per_serving = $fortail->per_serving; $berat_per_serving = round($berat_per_serving,5);
                $persen = $fortail->per_serving / $satu_persen; $persen = round($persen,2);
                $harga_per_serving = $berat_per_serving * $hpg; $harga_per_serving = round($harga_per_serving,2);
                // Per Batch
                $berat_per_batch = $fortail->per_batch; $berat_per_batch = round($berat_per_batch,5);
                $harga_per_batch = $berat_per_batch * $hpg; $harga_per_batch = round($harga_per_batch,2);
                // Per Kg
                $berat_per_kg = (1000 * $berat_per_serving) / $formula->serving; $berat_per_kg = round($berat_per_kg,5);
                $harga_per_kg = $berat_per_kg * $hpg; $harga_per_kg = round($harga_per_kg,2);       
            // Tampilkan
            $detail_harga->push([

                'id' => $fortail->id,
                'kode_komputer' => $bahan->kode_komputer,
                'nama_sederhana' => $bahan->nama_sederhana,
                'hpg' => $hpg,
                'per_serving' =>  $berat_per_serving,
                'persen' => $persen,
                'harga_per_serving' => $harga_per_serving,
                'per_batch' => $berat_per_batch,
                'harga_per_batch' => $harga_per_batch,
                'per_kg' => $berat_per_kg,
                'harga_per_kg' => $harga_per_kg

            ]);

            // Count Total
            $total_harga_per_gram = $total_harga_per_gram + $hpg;
            $total_berat_per_serving = $total_berat_per_serving + $berat_per_serving;
            $total_harga_per_serving = $total_harga_per_serving + $harga_per_serving;
            $total_berat_per_batch = $total_berat_per_batch + $berat_per_batch;
            $total_harga_per_batch = $total_harga_per_batch + $harga_per_batch;
            $total_berat_per_kg = $total_berat_per_kg + $berat_per_kg;
            $total_harga_per_kg = $total_harga_per_kg + $harga_per_kg;
        }

        $total_harga = collect([
            'total_harga_per_gram' => $total_harga_per_gram,
            'total_berat_per_serving' => $total_berat_per_serving,
            'total_persen' => 100,
            'total_harga_per_serving' => $total_harga_per_serving,
            'total_berat_per_batch' => $total_berat_per_batch,
            'total_harga_per_batch' => $total_harga_per_batch,
            'total_berat_per_kg' => $total_berat_per_kg,
            'total_harga_per_kg' => $total_harga_per_kg,                       
        ]);



        return view('devwb/detailformula',  compact('ing','tampilkan','AMC','AMC2','AMC3','AMC4','AMC5','AMC6','AMC7',
        'data','vit_a','thi','rib','nia','b5','pyr','b7','b12','asam','vit_c',
        'vit_d','vit_e','mag','man','zin','lod','zat','sel','mol','ino' ,'id'  ))->with([
            'ada'     => $ada,
            'formula' => $formula,
            'detail_formula' =>  $detail_formula,
            'granulasi' => $granulasi,
            'gp' => $gp,
            'detail_harga' => $detail_harga,
            'total_harga' => $total_harga
        ]);
    }
 
}
