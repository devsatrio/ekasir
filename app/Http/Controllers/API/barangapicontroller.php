<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;

class barangapicontroller extends Controller
{
    //============================================================
    public function getdata()
    {
        $data = Barang::all();
        return response()->json($data);
    }
}
