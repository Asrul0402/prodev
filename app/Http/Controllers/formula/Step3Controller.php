<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\master\Subbrand;
use App\master\Gudang;
use App\master\Produksi;
use App\master\Maklon;
use App\User;
use App\users\Departement;
use App\dev\Workbook;
use App\dev\Formula;
use App\dev\Fortail;
use App\dev\Premix;
use App\dev\Pretail;
use App\dev\Bahan;

class Step3Controller extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
    
    public function create($id){
        $no = 0;
        $formula = Formula::where('id',$id)->first();
        $idf = $formula->id;
        $fortails = Fortail::where('formula_id',$formula->id)->get();
        return view('formula/step3')->with([
            'no' => $no,
            'idf' => $idf,
            'fortails' => $fortails,
            'formula' => $formula
            ]);
    }


    public function insert($idf,Request $request){

        $c_premix = $request->c_premix;

        for($cp = 1 ; $cp<= $c_premix ; $cp++){
            
            $id = $request->prid[$cp];
            // Delete Last Pretail
            $del_pretail = Pretail::where('premix_id',$id)->get();
            foreach($del_pretail as $df){
                $df->delete();
            }
            
            // Insert Utuh CPB dan Koma CPB
            $myPremix = Premix::where('id',$id)->first();
            $myPremix->utuh_cpb = $request->utuh_cpb[$cp];
            $myPremix->koma_cpb = $request->koma_cpb[$cp];
            $myPremix->save();
            
            // Insert Pretail

            for($cpt = 1 ; $cpt <= 10 ; $cpt++){
                $myPretail = $request->ke[$cpt][$cp];
                $turunan = $request->turunan[$cpt];
                if($myPretail != ''){
                    if($turunan >= 1){
                        $myPretail = $myPretail/$turunan;
                        for($tur = 1 ; $tur <= $turunan; $tur++){
                            $pretail = new Pretail;
                            $pretail->premix_id = $myPremix->id;
                            $pretail->premix_ke = $cpt;
                            $pretail->turunan = $tur;
                            $pretail->save();
                        }                        
                    }
                    else if($turunan < 1 || $turunan == null){
                            $pretail = new Pretail;
                            $pretail->premix_id = $myPremix->id;
                            $pretail->premix_ke = $cpt;
                            $pretail->jumlah = $myPretail;
                            $pretail->save();
                    }
                }
            }
            
        }

    }

    
}
