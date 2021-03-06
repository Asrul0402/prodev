<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\users\Departement;
use App\User;
use Redirect;

class DepartementController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:admin');
    }

    public function dept(){
        $depts = Departement::all();
        $users = User::where([
            ['status','active']
        ])->get();
        return view('admin.depts')->with([
            'depts' => $depts,
            'users' => $users]);

    }

    public function deldept($id){
        $dept = Departement::where('id',$id)->first();
        $n = $dept->dept;
        $dept->delete();

        return Redirect::back()->with('error', 'Departement '.$n.' Telah Dihapus!');
    }

    public function adddept(Request $request){
        $dept = new Departement;
        $dept->dept = $request->dept;
        $dept->nama_dept = $request->nama_dept;
        $dept->manager_id = $request->manager;
        $dept->save();

        return Redirect::back()->with('status', 'Departement '.$dept->dept.' Telah Ditambahkan!');
    }

    public function formupdatedept($id){
        $dept = Departement::where([
            ['id',$id]
            ])->first();
        $users = User::where([
            ['status','active']
        ])->get();


        return view('admin.editdept')->with([
            'dept' => $dept,
            'users' => $users
        ]);
    }

    public function saveupdateDept($id,Request $request){
        $dept = Departement::where('id',$id)->first();
        $dept->dept = $request->dept;
        $dept->nama_dept = $request->nama_dept;
        $dept->manager_id = $request->manager;
        $dept->save();

        return Redirect()->route('dept')->with('status', 'Departement '.$dept->dept.' Telah DiUpdate!');
        
    }
}
