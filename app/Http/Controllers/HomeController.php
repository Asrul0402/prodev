<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use App\User;

class homeController extends Controller
{
     // untuk mengakses homecontroller user harus login terlebih dahulu

     public function __construct()

     {
         $this->middleware('auth');
     }
     // akses ke home menyesuaikan tipe akses user
 
     public function home()
 
     {
         // jika admin
             // user() : model user
             // ->role : relasi dgn tabel role
             // ->namaRule : kolom 'role' pada table 'role'
 
         if (auth()->check() && Auth::user()->role->namaRule == 'admin'){
            return Redirect::route('userapproval');
         // jika non admin
         }elseif (auth()->check() && Auth::user()->role->namaRule == 'manager'){
            return Redirect::route('dasboardmanager');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'marketing'){
            return Redirect::route('dasboardnr');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'user_produk'){
            return Redirect::route('dasboardawal');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'user_rd_proses'){
            return Redirect::route('dasboardawal');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'pv_global'){
            return Redirect::route('dasboardpv');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'pv_lokal'){
            return Redirect::route('dasboardpv');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'produksi'){
            return Redirect::route('formula.feasibility');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'kemas'){
            return Redirect::route('dasboardawal');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'evaluator'){
            return Redirect::route('formula.feasibility');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'finance'){
            return Redirect::route('formula.feasibility');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'NR'){
            return Redirect::route('dasboardnr');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'CS'){
            return Redirect::route('dasboardcs');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'lab'){
            return Redirect::route('formula.feasibility');
         // selain itu tampilkan form login
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'maklon'){
            return Redirect::route('dasboardmaklon');
         // selain itu tampilkan form login
         }else{
             return view ('login');
         }
 
     }
}
