<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Auth;
use Redirect;
use DB;

use App\pkp\pkp_type;
use App\pkp\pkp_project;
use App\pkp\project_pdf;
use App\pkp\pkp_detail_project;
use App\pkp\pkp_uniq_idea;
use App\pkp\pkp_estimasi_market;
use App\master\Brand;
use App\pkp\menu;
use App\pkp\jenismenu;
use App\pkp\notulen;
use App\master\Tarkon;
use App\notification;
use App\pkp\data_klaim;
use App\pkp\data_detail_klaim;
use App\pkp\uom;
use App\pkp\tb_edit;
use App\pkp\promo;
use App\pkp\data_forecast;
use App\pkp\product_allocation;
use App\pkp\data_ses;
use App\kemas\datakemas;
use App\pkp\data_promo;
use App\pkp\parameter_form;
use App\nutfact\datapangan;
use App\pkp\coba;
use App\pkp\tipp;
use App\nutfact\pangan;
use App\manager\pengajuan;
use App\pkp\picture;
use App\users\Departement;

class pkp2Controller extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:NR' || 'rule:marketing' || 'rule:manager');
    }

    public function template($id_project){
        $pkp = tipp::where('id_pkp',$id_project)->max('turunan');
        $max = tipp::where('id_pkp',$id_project)->max('revisi');
        $pkp1 = pkp_project::where('id_project',$id_project)->first();
        $project = new pkp_project;
        $project->project_name=$pkp1->project_name;
        $project->id_brand=$pkp1->id_brand;
        $project->jenis=$pkp1->jenis;
        $project->created_date=$pkp1->created_date;
        $project->author=Auth::user()->name;
        $project->type=$pkp1->type;
        $project->save();

            $clf=tipp::where('id_pkp',$id_project)->count();
            if($clf>0){
                $isipkp=tipp::where('turunan',$pkp)->where('revisi',$max)->get();
                foreach ($isipkp as $pkpp)
                {
                $tip= new tipp;
                $tip->id_pkp=$project->id_project;
                $tip->idea=$pkpp->idea;
                $tip->gender=$pkpp->gender;
                $tip->dariumur=$pkpp->dariumur;
                $tip->sampaiumur=$pkpp->sampaiumur;
                $tip->Uniqueness=$pkpp->Uniqueness;
                $tip->reason=$pkpp->reason;
                $tip->Estimated=$pkpp->Estimated;
                $tip->launch=$pkpp->launch;
                $tip->years=$pkpp->years;
                $tip->olahan=$pkpp->olahan;
                $tip->revisi='0';
                $tip->turunan='0';
                $tip->tgl_launch=$pkpp->tgl_launch;
                $tip->competitive=$pkpp->competitive;
                $tip->selling_price=$pkpp->selling_price;
                $tip->competitor=$pkpp->competitor;
                $tip->aisle=$pkpp->aisle;
                $tip->UOM=$pkpp->UOM;
                $tip->price=$pkpp->price;
                $tip->product_form=$pkpp->product_form;
                $tip->bpom=$pkpp->bpom;
                $tip->status_data=$pkpp->status_data;
                $tip->kategori_bpom=$pkpp->kategori_bpom;
                $tip->akg=$pkpp->akg;
                $tip->primer=$pkpp->primer;
                $tip->status_pkp='draf';
                $tip->revisi='0';
                $tip->primery=$pkpp->primery;
                $tip->secondary=$pkpp->secondary;
                $tip->tertiary=$pkpp->tertiary;
                $tip->kemas_eksis=$pkpp->kemas_eksis;
                $tip->prefered_flavour=$pkpp->prefered_flavour;
                $tip->product_benefits=$pkpp->product_benefits;
                $tip->mandatory_ingredient=$pkpp->mandatory_ingredient;
                $tip->gambaran_proses=$pkpp->gambaran_proses;
                $tip->save();
                }
            }
            $picture=picture::where('pkp_id',$id_project)->count();
            if($picture>0){
                $isipicturepkp=picture::where('pkp_id',$id_project)->where('revisi',$max)->get();
                foreach ($isipicturepkp as $ppkp)
                {
                    $gambar= new picture;
                    $gambar->filename=$ppkp->filename;
                    $gambar->pkp_id=$project->id_project;
                    $gambar->lokasi=$ppkp->lokasi;
                    $gambar->revisi='0';
                    $gambar->turunan='0';
                    $gambar->save();
                }
            }

            $datases=data_ses::where('id_pkp',$id_project)->count();
            if($datases>0){
                $isises=data_ses::where('id_pkp',$id_project)->where('revisi',$max)->get();
                foreach ($isises as $isises)
                {
                    $data1= new data_ses;
                    $data1->id_pkp=$project->id_project;
                    $data1->revisi='0';
                    $data1->turunan='0';
                    $data1->ses=$isises->ses;
                    $data1->save();
                }
            }

            $datafor=data_forecast::where('id_pkp',$id_project)->count();
            if($datafor>0){
                $isifor=data_forecast::where('id_pkp',$id_project)->where('revisi',$max)->get();
                foreach ($isifor as $isifor)
                {
                    $data1= new data_forecast;
                    $data1->id_pkp=$project->id_project;
                    $data1->turunan='0';
                    $data1->revisi='0';
                    $data1->forecast=$isifor->forecast;
                    $data1->satuan=$isifor->satuan;
                    $data1->save();
                }
            }

            $datak = data_klaim::where('id_pkp',$id_project)->count();
            if($datafor>0){
                $isikl=data_klaim::where('id_pkp',$id_project)->where('revisi',$max)->get();
                foreach ($isikl as $isikl)
                {
                    $pipeline = new data_klaim;
                    $pipeline->id_pkp=$project->id_project;
                    $pipeline->turunan='0';
                    $pipeline->id_klaim = $isikl->id_klaim;
                    $pipeline->id_komponen = $isikl->id_komponen;
                    $pipeline->note= $isikl->note;
                    $pipeline->save();
                }
            
            }
    
            $detailklaim=data_detail_klaim::where('id_pkp',$id_project)->count();
            if($detailklaim>0){
                $isidetail=data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$max)->get();
                foreach ($isidetail as $isidetail)
                {
                    $detail= new data_detail_klaim;
                    $detail->id_pkp=$isidetail->id_pkp;
                    $detail->revisi=$naikversi;
                    $detail->turunan=$isidetail->turunan;
                    $detail->id_detail=$isidetail->id_detail;
                    $detail->save();
                }
            }
            return Redirect::Route('bagian1',['id_pkp' => $tip->id_pkp, 'revisi' => $tip->revisi, 'turunan' => $tip->turunan]);
    }

    public function tabulasi(){
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $pic = picture::all();
        $pkp = tipp::max('turunan');
        $pdf = coba::max('turunan');
        $notpkp = notulen::where('id_pkp','!=','null')->count();
        $notpdf = notulen::where('id_pdf','!=','null')->count();
        $notpromo = notulen::where('id_promo','!=','null')->count();
        $promo = data_promo::max('turunan');
        $hitungnotif = $pengajuan + $notif;
        $datapkp = pkp_project::where('status_project','!=','draf') ->join('tippu','pkp_project.id_project','=','tippu.id_pkp')->where('status_data','=','active')->get();
        $datapdf = project_pdf::where('status_project','!=','draf') ->join('tipu','pdf_project.id_project_pdf','=','tipu.pdf_id')->where('status_pdf','=','active')->get();
        $datapromo = promo::where('status_project','!=','draf') ->join('isi_promo','pkp_promo.id_pkp_promo','=','isi_promo.id_pkp_promoo')->where('status_data','=','active')->get();
        return view('pv.tabulasi')->with([
            'datapkp' => $datapkp,
            'datapdf' => $datapdf,
            'not' => $notpkp,
            'notpdf' => $notpdf,
            'notpkp' => $notpkp,
            'notpromo' => $notpromo,
            'pic' => $pic,
            'datapromo' => $datapromo,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function editpkpall(){
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $brand = brand::all();
        $uom = uom::all();
        $par2 = parameter_form::where('user',Auth::user()->id)->limit('1')->get();
        $tarkon = Tarkon::all();
        $hitungnotif = $pengajuan + $notif;
        $datapkp = pkp_project::where('status_project','!=','draf') ->join('tippu','pkp_project.id_project','=','tippu.id_pkp')
        ->join('tb_edit','tb_edit.id_pkp','=','pkp_project.id_project')
        ->join('tb_parameter_form','tb_parameter_form.id_pkp','pkp_project.id_project')->where('id_user',Auth::user()->id)->where('status_data','=','active')->get();
        return view('pv.editpkpall')->with([
            'datapkp' => $datapkp,
            'pesan' => $pesan,
            'notif' =>$notif,
            'brand' => $brand,
            'par2' => $par2,
            'uom' => $uom,
            'tarkon' => $tarkon,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,  
        ]) ;  
    }

    public function hapuscheck(){
        $check = tb_edit::where('id_pkp','!=','NULL')->where('id_user',Auth::user()->id)->delete();
        $check = parameter_form::where('user',Auth::user()->id)->delete();
        return redirect::route('tabulasi');
    }

    public function hapuscheckpdf(){
        $check = tb_edit::where('id_pdf','!=','NULL')->where('id_user',Auth::user()->id)->delete();
        $check = parameter_form::where('user',Auth::user()->id)->delete();
        return redirect::route('tabulasi');
    }

    public function hapuscheckpromo(){
        $check = tb_edit::where('id_promo','!=','NULL')->where('id_user',Auth::user()->id)->delete();
        $check = parameter_form::where('user',Auth::user()->id)->delete();
        return redirect::route('tabulasi');
    }

    public function editpdfall(){
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $type= pkp_type::all();
        $brand = brand::all();
        $par = parameter_form::where('user',Auth::user()->id)->limit('1')->get();
        $hitungnotif = $pengajuan + $notif;
        $datapdf = project_pdf::where('status_project','!=','draf') ->join('tipu','pdf_project.id_project_pdf','=','tipu.pdf_id')
        ->join('tb_edit','tb_edit.id_pdf','=','pdf_project.id_project_pdf')
        ->join('tb_parameter_form','tb_parameter_form.id_pdf','pdf_project.id_project_pdf')->where('id_user',Auth::user()->id)->where('status_pdf','=','active')->get();
        $datapdf1 = project_pdf::where('status_project','!=','draf') ->join('tipu','pdf_project.id_project_pdf','=','tipu.pdf_id')
        ->join('tb_edit','tb_edit.id_pdf','=','pdf_project.id_project_pdf')
        ->join('tb_parameter_form','tb_parameter_form.id_pdf','pdf_project.id_project_pdf')->where('id_user',Auth::user()->id)->where('status_pdf','=','active')->get();
        return view('pv.editpdfall')->with([
            'datapdf' => $datapdf,
            'brand' => $brand,
            'pesan' => $pesan,
            'datapdf1' => $datapdf1,
            'type' => $type,
            'notif' =>$notif,
            'par' => $par,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif  
        ]) ;  
    }

    public function editpromoall(){
        $pengajuan = pengajuan::count();
        $brand = brand::all();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $par = parameter_form::where('user',Auth::user()->id)->limit('1')->get();
        $hitungnotif = $pengajuan + $notif;
        $datapromo = promo::where('status_project','!=','draf') ->join('isi_promo','pkp_promo.id_pkp_promo','=','isi_promo.id_pkp_promoo')
        ->join('tb_edit','tb_edit.id_promo','=','pkp_promo.id_pkp_promo')->where('id_user',Auth::user()->id)
        ->join('tb_parameter_form','tb_parameter_form.id_promo','pkp_promo.id_pkp_promo')->where('status_data','=','active')->get();
        return view('pv.editpromo')->with([
            'datapromo' => $datapromo,
            'pesan' => $pesan,
            'brand' => $brand,
            'par' => $par,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,  
        ]) ;  
    }

    public function update_pkp(Request $request) { 
        $scores = $request->input('scores');
        foreach($scores as $row){
            $tambah = new tipp;
                $tambah->id_pkp=$row['id_pkp'];
                $tambah->turunan=$row['turun'];
                $tambah->revisi=$row['revisi'];
                $tambah->idea=$row['idea'];
                $tambah->gender=$row['gender'];
                $tambah->dariumur=$row['dariumur'];
                $tambah->sampaiumur=$row['sampaiumur'];
                $tambah->Uniqueness=$row['uniq'];
                $tambah->reason=$row['reason'];
                $tambah->Estimated=$row['estimated'];
                $tambah->launch=$row['launch'];
                $tambah->years=$row['years'];
                $tambah->tgl_launch=$row['tgl'];
                $tambah->competitive=$row['competitive'];
                $tambah->selling_price=$row['selling'];
                $tambah->competitor=$row['competitor'];
                $tambah->aisle=$row['aisle'];
                $tambah->product_form=$row['form'];
                $tambah->bpom=$row['bpom'];
                $tambah->kategori_bpom=$row['katbpom'];
                $tambah->olahan=$row['olahan'];
                $tambah->akg=$row['tarkon'];
                $tambah->primer=$row['primer'];
                $tambah->primery=$row['primary'];
                $tambah->secondary=$row['secondary'];
                $tambah->tertiary=$row['tertiary'];
                $tambah->kemas_eksis=$row['eksis'];
                $tambah->prefered_flavour=$row['prefered'];
                $tambah->product_benefits=$row['benefits'];
                $tambah->mandatory_ingredient=$row['ingredient'];
                $tambah->price=$row['price'];
                $tambah->UOM=$row['uom'];
                $tambah->status_pkp=$row['data'];
                $tambah->save();
            
            $turunan = tipp::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->update([
                "status_data" => $row['status']
            ]);

            foreach($scores as $row){
            
            $pkp = pkp_project::where('id_project',$row['id_pkp'])->update([
                "project_name" => $row['name'],
                "id_brand" => $row['brand'],
                "ket_no" => $row['ket'],
                "note" => $row['note'],
                "type" => $row['type']
            ]);

        $data=data_ses::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($data>0){
            $data=data_ses::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $ses= new data_ses;
                $ses->id_pkp=$data->id_pkp;
                $ses->revisi=$tambah->revisi;
                $ses->turunan=$data->turunan;
                $ses->ses=$data->ses;
                $ses->save();
            }
        }

        $for=data_forecast::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($for>0){
            $data=data_forecast::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $forecast= new data_forecast;
                $forecast->id_pkp=$data->id_pkp;
                $forecast->revisi=$tambah->revisi;
                $forecast->turunan=$data->turunan;
                $forecast->forecast=$data->forecast;
                $forecast->satuan=$data->satuan;
                $forecast->save();
            }
        }

        $kl=data_klaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($kl>0){
            $data=data_klaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $klaim= new data_klaim;
                $klaim->id_pkp=$data->id_pkp;
                $klaim->revisi=$tambah->revisi;
                $klaim->turunan=$data->turunan;
                $klaim->id_komponen=$data->id_komponen;
                $klaim->komponen=$data->komponen;
                $klaim->id_klaim=$data->id_klaim;
                $klaim->note=$data->note;
                $klaim->save();
            }
        }

        $ddk=data_detail_klaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($ddk>0){
            $data=data_detail_klaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $detail= new data_detail_klaim;
                $detail->id_pkp=$data->id_pkp;
                $detail->revisi=$tambah->revisi;
                $detail->turunan=$data->turunan;
                $detail->id_detail=$data->id_detail;
                $detail->id_klaim=$data->id_klaim;
                $detail->save();
            }
        }
        }
        }
        return redirect::back()->with('status', 'Revised data ');
    } 

    public function update_pdf(Request $request){
        $data1 = $request->input('datapdf');    
        foreach($data1 as $row){
            
            $tambah = new coba;
            $tambah->pdf_id = $row['id_pdf'];
            $tambah->primer=$row['primer'];
            $tambah->primery=$row['primary'];
            $tambah->secondery=$row['secondary'];
            $tambah->Tertiary=$row['tertiary'];
            $tambah->kemas_eksis=$row['eksis'];
            $tambah->dariusia= $row['dariusia'];
            $tambah->sampaiusia= $row['sampaiusia'];
            $tambah->gender= $row['gender'];
            $tambah->other= $row['other'];
            $tambah->wight= $row['wight'];
            $tambah->serving= $row['serving'];
            $tambah->target_price= $row['target'];
            $tambah->claim= $row['claim'];
            $tambah->ingredient= $row['ingredient'];
            $tambah->background= $row['background'];
            $tambah->attractiveness= $row['attractive'];
            $tambah->rto= $row['rto'];
            $tambah->name= $row['name2'];
            $tambah->retailer_price= $row['retailer'];
            $tambah->special= $row['special'];
            $tambah->turunan=$row['turun'];
            $tambah->revisi=$row['rev'];
            $tambah->status_data='sent';
            $tambah->save();
        
            $turunan = coba::where('pdf_id',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->update([
                "status_pdf" => $row['status']
            ]);

            foreach($data1 as $row){

            $pdf = project_pdf::where('id_project_pdf',$row['id_pdf'])->update([
                "project_name" => $row['name'],
                "id_brand" => $row['brand'],
                "country" => $row['country'],
                "ket_no" =>$row['ket'],
                "reference" => $row['reference'],
                "id_type" => $row['type']
            ]);

        $data=data_ses::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($data>0){
            $data=data_ses::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $ses= new data_ses;
                $ses->id_pdf=$data->id_pdf;
                $ses->revisi=$tambah->revisi;
                $ses->turunan=$data->turunan;
                $ses->ses=$data->ses;
                $ses->save();
            }
        }

        $for=data_forecast::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($for>0){
            $data=data_forecast::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $forecast= new data_forecast;
                $forecast->id_pdf=$data->id_pdf;
                $forecast->revisi=$tambah->revisi;
                $forecast->turunan=$data->turunan;
                $forecast->forecast=$data->forecast;
                $forecast->satuan=$data->satuan;
                $forecast->save();
            }
        }
        }
        }
        return redirect::back()->with('status', 'Revised data ');
    }

    public function update_promo(Request $request){
        $data1 = $request->input('datapromo');

        foreach($data1 as $row){
            $tambah = new data_promo;
            $tambah->id_pkp_promoo = $row['id_promo'];
            $tambah->promo_idea = $row['idea'];
            $tambah->dimension = $row['dimension'];
            $tambah->application = $row['app'];
            $tambah->revisi = $row['rev'];
            $tambah->turunan = $row['turun'];
            $tambah->promo_readiness = $row['readines'];
            $tambah->rto = $row['rto'];
            $tambah->gambaran_proses = $row['gambaran_proses'];
            $tambah->save();

            $turunan = data_promo::where('id_pkp_promoo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->update([
                "status_data" => 'inactive'
            ]);

            foreach($data1 as $row){

            $pdf = promo::where('id_pkp_promo',$row['id_promo'])->update([
                "project_name" => $row['name'],
                "brand" => $row['brand'],
                "ket_no" => $row['ket'],
                "promo_type" => $row['promotype'],
                "country" => $row['country'],
                "type" => $row['type']
            ]);

        $for=product_allocation::where('id_pkp_promo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->count();
        if($for>0){
            $data=product_allocation::where('id_pkp_promo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->get();
            foreach ($data as $data)
            {
                $all= new product_allocation;
                $all->id_pkp_promo=$data->id_pkp_promo;
                $all->product_sku=$data->product_sku;
                $all->allocation=$data->allocation;
                $all->remarks=$data->remarks;
                $all->start=$data->start;
                $all->end=$data->end;
                $all->rto=$data->rto;
                $all->opsi=$data->opsi;
                $all->revisi=$tambah->revisi;
                $all->turunan=$data->turunan;
                $all->save();
            }
        }
        }
        }
        return redirect::back()->with('status', 'Revised data ');
    }

    public function checkpkp(Request $request){
        $rules = array(
        ); 
        
        if($request->datapkp!=''){
        $validator = Validator::make($request->all(), $rules);  
        if ($validator->passes()) {
        $idz = implode(",", $request->input('datapkp'));
        $ids = explode(",", $idz);
        for ($i = 0; $i < count($ids); $i++)
        {
            $pipeline = new tb_edit;
            $pipeline->id_user=Auth::user()->id;
            $pipeline->id_pkp = $ids[$i];
            $pipeline->save();
            $i = $i++;

                }
            }
        
        $form=tb_edit::where('id_user',$pipeline->id_user)->count();
        if($form>0){
            $data=tb_edit::where('id_user',$pipeline->id_user)->get();
            foreach ($data as $data)
            {
                $par= new parameter_form;
                $par->id_pkp=$data->id_pkp;
                $par->user=$request->user;
                $par->form1=$request->par1;
                $par->form2=$request->par2;
                $par->form3=$request->par3;
                $par->form4=$request->par4;
                $par->form5=$request->par5;
                $par->form6=$request->par6;
                $par->form7=$request->par7;
                $par->form8=$request->par8;
                $par->form9=$request->par9;
                $par->form10=$request->par10;
                $par->form11=$request->par11;
                $par->form12=$request->par12;
                $par->form13=$request->par13;
                $par->form14=$request->par14;
                $par->form15=$request->par15;
                $par->form16=$request->par16;
                $par->form17=$request->par17;
                $par->form18=$request->par18;
                $par->form19=$request->par19;
                $par->form20=$request->par20;
                $par->save();
            }
        }
        
        }
        return redirect::Route('editpkpall');
    }
    
    public function checkpdf(Request $request){
        $rules = array(
        ); 
        
        if($request->datapdf!=''){
        $validator = Validator::make($request->all(), $rules);  
        if ($validator->passes()) {
        $idz = implode(",", $request->input('datapdf'));
        $ids = explode(",", $idz);
        for ($i = 0; $i < count($ids); $i++)
        {
            $pipeline = new tb_edit;
            $pipeline->id_user=Auth::user()->id;
            $pipeline->id_pdf = $ids[$i];
            $pipeline->save();
            $i = $i++;

            }
        }

        $form=tb_edit::where('id_user',$pipeline->id_user)->count();
        if($form>0){
            $data=tb_edit::where('id_user',$pipeline->id_user)->get();
            foreach ($data as $data)
            {
                $par= new parameter_form;
                $par->id_pdf=$data->id_pdf;
                $par->user=$request->user;
                $par->form1=$request->par1;
                $par->form2=$request->par2;
                $par->form3=$request->par3;
                $par->form4=$request->par4;
                $par->form5=$request->par5;
                $par->form6=$request->par6;
                $par->form7=$request->par7;
                $par->form8=$request->par8;
                $par->form9=$request->par9;
                $par->form10=$request->par10;
                $par->form11=$request->par11;
                $par->form12=$request->par12;
                $par->form13=$request->par13;
                $par->form14=$request->par14;
                $par->form15=$request->par15;
                $par->form16=$request->par16;
                $par->form17=$request->par17;
                $par->form18=$request->par18;
                $par->form19=$request->par19;
                $par->save();
            }
        }
        
        }

        return redirect::Route('editpdfall');
    }

    public function checkpromo(Request $request){
        if($request->datapromo!=''){
        $rules = array(
        ); 
        
        $validator = Validator::make($request->all(), $rules);  
        if ($validator->passes()) {
        $idz = implode(",", $request->input('datapromo'));
        $ids = explode(",", $idz);
        for ($i = 0; $i < count($ids); $i++)
        {
            $pipeline = new tb_edit;
            $pipeline->id_user=Auth::user()->id;
            $pipeline->id_promo = $ids[$i];
            $pipeline->save();
            $i = $i++;

                }
            }

        $form=tb_edit::where('id_user',$pipeline->id_user)->count();
        if($form>0){
            $data=tb_edit::where('id_user',$pipeline->id_user)->get();
            foreach ($data as $data)
            {
                $par= new parameter_form;
                $par->id_promo=$data->id_promo;
                $par->user=$request->user;
                $par->form1=$request->par1;
                $par->form2=$request->par2;
                $par->form3=$request->par3;
                $par->form4=$request->par4;
                $par->form5=$request->par5;
                $par->form6=$request->par6;
                $par->form7=$request->par7;
                $par->form8=$request->par8;
                $par->form9=$request->par9;
                $par->form10=$request->par10;
                $par->save();
            }
        }  
    }

        return redirect::Route('editpromoall');
    }

    public function deletepdf1($id_project_pdf){
        $pdf = tb_edit::where('id_pdf',$id_project_pdf)->first();
        $pdf->delete();

        return redirect::back();
    }

    public function deletepkp1($id_project){
        $promo = tb_edit::where('id_pkp',$id_project)->first();
        $promo->delete();

        return redirect::back();
    }

    public function deletepromo1($id_pkp_promo){
        $promo = tb_edit::where('id_promo',$id_pkp_promo)->first();
        $promo->delete();

        return redirect::back();
    }

    public function notulenpdf(){
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $type= pkp_type::all();
        $brand = brand::all();
        $par = parameter_form::where('user',Auth::user()->id)->limit('1')->get();
        $hitungnotif = $pengajuan + $notif;
        $datapdf = project_pdf::where('status_project','!=','draf') ->join('tipu','pdf_project.id_project_pdf','=','tipu.pdf_id')
        ->join('tb_parameter_form','tb_parameter_form.id_pdf','pdf_project.id_project_pdf')->where('user',Auth::user()->id)->where('status_pdf','=','active')->get();
        $datapdf1 = project_pdf::where('status_project','!=','draf') ->join('tipu','pdf_project.id_project_pdf','=','tipu.pdf_id')
        ->join('tb_parameter_form','tb_parameter_form.id_pdf','pdf_project.id_project_pdf')->where('user',Auth::user()->id)->where('status_pdf','=','active')->get();
        return view('pdf.notulen')->with([
            'datapdf' => $datapdf,'datapdf1' => $datapdf1,
            'brand' => $brand,
            'pesan' => $pesan,
            'type' => $type,
            'notif' =>$notif,
            'par' => $par,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,  
        ]) ;  
    }

    public function notulenpkp(){
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $brand = brand::all();
        $uom = uom::all();
        $par2 = parameter_form::where('user',Auth::user()->id)->limit('1')->get();
        $par = parameter_form::join('pkp_project','pkp_project.id_project','=','tb_parameter_form.id_pkp')->where('status_project','!=','draf')
        ->join('tb_edit','tb_edit.id_pkp','=','pkp_project.id_project')->where('id_user',Auth::user()->id)->get();
        $tarkon = Tarkon::all();
        $hitungnotif = $pengajuan + $notif;
        $datapkp = pkp_project::where('status_project','!=','draf') ->join('tippu','pkp_project.id_project','=','tippu.id_pkp')
        ->join('tb_parameter_form','tb_parameter_form.id_pkp','pkp_project.id_project')->where('user',Auth::user()->id)->where('status_data','=','active')->get();
        return view('pkp.notulen')->with([
            'datapkp' => $datapkp,
            'pesan' => $pesan,
            'notif' =>$notif,
            'brand' => $brand,
            'par' => $par,
            'par2' => $par2,
            'uom' => $uom,
            'tarkon' => $tarkon,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,  
            ]) ;  
    }

    public function notulenpkpp(Request $request){
        $scores = $request->input('scores');
        $scores1 = $request->input('scores1');
        $note = $request->input('note');
        $dat = $scores == $scores1;

       if($dat == 'true'){
            foreach($note as $note){
                    if($note!='null'){
                    $not = new notulen;
                    $not->id_pkp=$note['pkp'];
                    $not->note=$note['note'];
                    $not->save();
                }
            }
       }else{
        foreach($scores as $row){
            $tambah = new tipp;
                $tambah->id_pkp=$row['id_pkp'];
                $tambah->turunan=$row['turun'];
                $tambah->revisi=$row['revisi'];
                $tambah->idea=$row['idea'];
                $tambah->gender=$row['gender'];
                $tambah->dariumur=$row['dariumur'];
                $tambah->sampaiumur=$row['sampaiumur'];
                $tambah->Uniqueness=$row['uniq'];
                $tambah->reason=$row['reason'];
                $tambah->Estimated=$row['estimated'];
                $tambah->launch=$row['launch'];
                $tambah->years=$row['years'];
                $tambah->tgl_launch=$row['tgl'];
                $tambah->competitive=$row['competitive'];
                $tambah->selling_price=$row['selling'];
                $tambah->competitor=$row['competitor'];
                $tambah->aisle=$row['aisle'];
                $tambah->product_form=$row['form'];
                $tambah->bpom=$row['bpom'];
                $tambah->kategori_bpom=$row['katbpom'];
                $tambah->olahan=$row['olahan'];
                $tambah->akg=$row['tarkon'];
                $tambah->primer=$row['primer'];
                $tambah->primery=$row['primary'];
                $tambah->secondary=$row['secondary'];
                $tambah->tertiary=$row['tertiary'];
                $tambah->kemas_eksis=$row['eksis'];
                $tambah->prefered_flavour=$row['prefered'];
                $tambah->product_benefits=$row['benefits'];
                $tambah->mandatory_ingredient=$row['ingredient'];
                $tambah->price=$row['price'];
                $tambah->UOM=$row['uom'];
                $tambah->status_pkp=$row['data'];
                $tambah->save();
            
            $turunan = tipp::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->update([
                "status_data" => $row['status']
            ]);

            foreach($scores as $row){
            
            $pkp = pkp_project::where('id_project',$row['id_pkp'])->update([
                "project_name" => $row['name'],
                "id_brand" => $row['brand'],
                "ket_no" => $row['ket'],
                "type" => $row['type']
            ]);

        $data=data_ses::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($data>0){
            $data=data_ses::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $ses= new data_ses;
                $ses->id_pkp=$data->id_pkp;
                $ses->revisi=$tambah->revisi;
                $ses->turunan=$data->turunan;
                $ses->ses=$data->ses;
                $ses->save();
            }
        }

        $for=data_forecast::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($for>0){
            $data=data_forecast::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $forecast= new data_forecast;
                $forecast->id_pkp=$data->id_pkp;
                $forecast->revisi=$tambah->revisi;
                $forecast->turunan=$data->turunan;
                $forecast->forecast=$data->forecast;
                $forecast->satuan=$data->satuan;
                $forecast->save();
            }
        }

        $kl=data_klaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($kl>0){
            $data=data_klaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $klaim= new data_klaim;
                $klaim->id_pkp=$data->id_pkp;
                $klaim->revisi=$tambah->revisi;
                $klaim->turunan=$data->turunan;
                $klaim->id_komponen=$data->id_komponen;
                $klaim->komponen=$data->komponen;
                $klaim->id_klaim=$data->id_klaim;
                $klaim->note=$data->note;
                $klaim->save();
            }
        }

        $ddk=data_detail_klaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
        if($ddk>0){
            $data=data_detail_klaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
            foreach ($data as $data)
            {
                $detail= new data_detail_klaim;
                $detail->id_pkp=$data->id_pkp;
                $detail->revisi=$tambah->revisi;
                $detail->turunan=$data->turunan;
                $detail->id_detail=$data->id_detail;
                $detail->id_klaim=$data->id_klaim;
                $detail->save();
            }
        }
        }
        }
       }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function notulenpromo(){
        $pengajuan = pengajuan::count();
        $brand = brand::all();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $par = parameter_form::where('user',Auth::user()->id)->limit('1')->get();
        $hitungnotif = $pengajuan + $notif;
        $datapromo = promo::where('status_project','!=','draf') ->join('isi_promo','pkp_promo.id_pkp_promo','=','isi_promo.id_pkp_promoo')
        ->join('tb_parameter_form','tb_parameter_form.id_promo','pkp_promo.id_pkp_promo')->where('user',Auth::user()->id)->where('status_data','=','active')->get();
        return view('promo.notulen')->with([
            'datapromo' => $datapromo,
            'pesan' => $pesan,
            'brand' => $brand,
            'par' => $par,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif, 
        ]) ;  
    }

    public function notpkp(Request $request){
        $form=pkp_project::count();
        if($form>0){
            $data=pkp_project::all();
            foreach ($data as $data)
            {
                $par= new parameter_form;
                $par->id_pkp=$data->id_project;
                $par->user=$request->user;
                $par->form1=$request->par1;
                $par->form2=$request->par2;
                $par->form3=$request->par3;
                $par->form4=$request->par4;
                $par->form5=$request->par5;
                $par->form6=$request->par6;
                $par->form7=$request->par7;
                $par->form8=$request->par8;
                $par->form9=$request->par9;
                $par->form10=$request->par10;
                $par->form11=$request->par11;
                $par->form12=$request->par12;
                $par->form13=$request->par13;
                $par->form14=$request->par14;
                $par->form15=$request->par15;
                $par->form16=$request->par16;
                $par->form17=$request->par17;
                $par->form18=$request->par18;
                $par->form19=$request->par19;
                $par->form20=$request->par20;
                $par->save();
            }
        }

        return redirect::Route('notulenpkp');
    }

    public function notulenpdff(Request $request){
        $data1 = $request->input('datapdf');
        $data2 = $request->input('datapdf1');
        $note = $request->input('note');
        $dat = $data1 == $data2;

        if($dat=='true'){
            foreach($note as $note){
                $not = new notulen;
                $not->id_pdf=$note['pdf'];
                $not->note=$note['note'];
                $not->save();
            }
        }else{
            foreach($data1 as $row){
            
                $tambah = new coba;
                $tambah->pdf_id = $row['id_pdf'];
                $tambah->primer=$row['primer'];
                $tambah->primery=$row['primary'];
                $tambah->secondery=$row['secondary'];
                $tambah->Tertiary=$row['tertiary'];
                $tambah->kemas_eksis=$row['eksis'];
                $tambah->dariusia= $row['dariusia'];
                $tambah->sampaiusia= $row['sampaiusia'];
                $tambah->gender= $row['gender'];
                $tambah->other= $row['other'];
                $tambah->wight= $row['wight'];
                $tambah->serving= $row['serving'];
                $tambah->target_price= $row['target'];
                $tambah->claim= $row['claim'];
                $tambah->ingredient= $row['ingredient'];
                $tambah->background= $row['background'];
                $tambah->attractiveness= $row['attractive'];
                $tambah->rto= $row['rto'];
                $tambah->name= $row['name2'];
                $tambah->retailer_price= $row['retailer'];
                $tambah->special= $row['special'];
                $tambah->turunan=$row['turun'];
                $tambah->revisi=$row['rev'];
                $tambah->status_data='sent';
                $tambah->save();
            
                $turunan = coba::where('pdf_id',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->update([
                    "status_pdf" => 'inactive'
                ]);
    
                foreach($data1 as $row){
    
                $pdf = project_pdf::where('id_project_pdf',$row['id_pdf'])->update([
                    "project_name" => $row['name'],
                    "id_brand" => $row['brand'],
                    "country" => $row['country'],
                    "ket_no" =>$row['ket'],
                    "reference" => $row['reference'],
                    "id_type" => $row['type']
                ]);
    
            $data=data_ses::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
            if($data>0){
                $data=data_ses::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                foreach ($data as $data)
                {
                    $ses= new data_ses;
                    $ses->id_pdf=$data->id_pdf;
                    $ses->revisi=$tambah->revisi;
                    $ses->turunan=$data->turunan;
                    $ses->ses=$data->ses;
                    $ses->save();
                }
            }
    
            $for=data_forecast::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
            if($for>0){
                $data=data_forecast::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                foreach ($data as $data)
                {
                    $forecast= new data_forecast;
                    $forecast->id_pdf=$data->id_pdf;
                    $forecast->revisi=$tambah->revisi;
                    $forecast->turunan=$data->turunan;
                    $forecast->forecast=$data->forecast;
                    $forecast->satuan=$data->satuan;
                    $forecast->save();
                }
            }
            }
            }
        }

        return redirect::back()->with('status', 'Saved data ');
    }

    public function notpdf(Request $request){
        $form= project_pdf::count();
        if($form>0){
            $data= project_pdf::all();
            foreach ($data as $data)
            {
                $par= new parameter_form;
                $par->id_pdf=$data->id_project_pdf;
                $par->user=$request->user;
                $par->form1=$request->par1;
                $par->form2=$request->par2;
                $par->form3=$request->par3;
                $par->form4=$request->par4;
                $par->form5=$request->par5;
                $par->form6=$request->par6;
                $par->form7=$request->par7;
                $par->form8=$request->par8;
                $par->form9=$request->par9;
                $par->form10=$request->par10;
                $par->form11=$request->par11;
                $par->form12=$request->par12;
                $par->form13=$request->par13;
                $par->form14=$request->par14;
                $par->form15=$request->par15;
                $par->form16=$request->par16;
                $par->form17=$request->par17;
                $par->form18=$request->par18;
                $par->form19=$request->par19;
                $par->save();
            }
        }
        

        return redirect::Route('notulenpdf');
    }

    public function notulenpromoo(Request $request){
        $data1 = $request->input('datapromo');
        $data2 = $request->input('datapromo');
        $note = $request->input('note');
        $dat = $data1 == $data2;

        if($dat=='true'){
            foreach($note as $note){
                $not = new notulen;
                $not->id_promo=$note['promo'];
                $not->note=$note['note'];
                $not->save();
            }
        }else{
            foreach($data1 as $row){
                $tambah = new data_promo;
                $tambah->id_pkp_promoo = $row['id_promo'];
                $tambah->promo_idea = $row['idea'];
                $tambah->dimension = $row['dimension'];
                $tambah->application = $row['app'];
                $tambah->revisi = $row['rev'];
                $tambah->turunan = $row['turun'];
                $tambah->promo_readiness = $row['readines'];
                $tambah->rto = $row['rto'];
                $tambah->gambaran_proses = $row['gambaran_proses'];
                $tambah->save();
    
                $turunan = data_promo::where('id_pkp_promoo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->update([
                    "status_data" => $row['status']
                ]);
    
                foreach($data1 as $row){
    
                $pdf = promo::where('id_pkp_promo',$row['id_promo'])->update([
                    "project_name" => $row['name'],
                    "brand" => $row['brand'],
                    "ket_no" => $row['ket'],
                    "promo_type" => $row['promotype'],
                    "country" => $row['country'],
                    "type" => $row['type']
                ]);
    
            $for=product_allocation::where('id_pkp_promo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->count();
            if($for>0){
                $data=product_allocation::where('id_pkp_promo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->get();
                foreach ($data as $data)
                {
                    $all= new product_allocation;
                    $all->id_pkp_promo=$data->id_pkp_promo;
                    $all->product_sku=$data->product_sku;
                    $all->allocation=$data->allocation;
                    $all->remarks=$data->remarks;
                    $all->start=$data->start;
                    $all->end=$data->end;
                    $all->rto=$data->rto;
                    $all->opsi=$data->opsi;
                    $all->revisi=$tambah->revisi;
                    $all->turunan=$data->turunan;
                    $all->save();
                }
            }
            }
            }
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function notpromo(Request $request){
        $form=promo::count();
        if($form>0){
            $data=promo::all();
            foreach ($data as $data)
            {
                $par= new parameter_form;
                $par->id_promo=$data->id_pkp_promo;
                $par->user=$request->user;
                $par->form1=$request->par1;
                $par->form2=$request->par2;
                $par->form3=$request->par3;
                $par->form4=$request->par4;
                $par->form5=$request->par5;
                $par->form6=$request->par6;
                $par->form7=$request->par7;
                $par->form8=$request->par8;
                $par->form9=$request->par9;
                $par->form10=$request->par10;
                $par->save();
            }
        }  
        return redirect::Route('notulenpromo');
    }
}
