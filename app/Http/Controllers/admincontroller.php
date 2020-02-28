<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DataTables;
use App\User;

class admincontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //============================================================
    public function index()
    {
        return view('admin.index');
    }
    
    //============================================================
    public function getlistdata(){
        return Datatables::of(User::all())->make(true);
    }
    
    //============================================================
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::insert([
            'name'=>$request->nama,
            'username'=>$request->username,
            'notelp'=>$request->notelp,
            'level'=>$request->level,
            'password'=>Hash::make($request->password),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::where('id',$id)->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->password==''){
            User::find($id)->update([
                'name'=>$request->nama,
                'username'=>$request->username,
                'notelp'=>$request->notelp,
                'level'=>$request->level,
            ]);
        }else{
            User::find($id)->update([
                'name'=>$request->nama,
                'username'=>$request->username,
                'notelp'=>$request->notelp,
                'level'=>$request->level,
                'password'=>Hash::make($request->password),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}
