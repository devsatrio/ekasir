<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use DataTables;

class barangcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //============================================================
    public function index()
    {
        return view('barang.index');
    }
    
    //============================================================
    public function getlistdata(){
        return Datatables::of(Barang::all())->make(true);
    }
    
    //============================================================
    public function carikode($kode){
        $data = Barang::where('kode',$kode)->count();
        return response()->json($data);
    }

    //============================================================
    public function store(Request $request)
    {
        Barang::insert([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'harga_beli'=>$request->hargabeli,
            'harga_jual'=>$request->hargajual,
            'status_stok'=>$request->opsistok,
        ]);
    }

    //============================================================
    public function show($id)
    {
        $data = Barang::where('id',$id)->get();
        return response()->json($data);
    }

    //============================================================
    public function update(Request $request, $id)
    {
        Barang::find($id)->update([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'harga_beli'=>$request->hargabeli,
            'harga_jual'=>$request->hargajual,
            'status_stok'=>$request->opsistok,
        ]);
    }

    //============================================================
    public function destroy($id)
    {
        Barang::destroy($id);
    }
}
