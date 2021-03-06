<?php

namespace App\Http\Controllers\finance;

use App\Modelmesin\Dmesin;
use App\Modelmesin\datamesin;
use Illuminate\Http\Request;
use paginate;
use App\Http\Controllers\Controller;

class ajax extends Controller
{


    public function index()
    {
        $mesins = datamesin::all();
        return response()->json($mesins);
    }

    public function store(Request $request)
    {
        $mesin = Dmesin::create($request->all());
        return response()->json($mesin);
    }
    
    public function update(Request $request, $id)
    {
        $mes = Dmesin::find($id)->update($request->all());
        return response()->json($mes);
    }

    public function destroy($id)
    {
        Dmesin::find($id)->delete();
        return response()->json(['done']);
    }
}
