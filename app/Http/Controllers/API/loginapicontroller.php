<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class loginapicontroller extends Controller
{
    //============================================================
    public function login(Request $request)
    {
        $username = $request->username;
        $mypassword = $request->password;
        $data = DB::table('users')
        ->where('username',$username)
        ->count();
        
        if($data > 0){
            $datausers = DB::table('users')
            ->where('username',$username)
            ->get();
            
            foreach ($datausers as $du) {
                $id = $du->id;
                $mypass = $du->password;
            }

            if(Hash::check($mypassword,$mypass)){
                return response()->json(['status'=>'1','data'=>$datausers]);
            }else{
                return response()->json(['status'=>'0']);
            }
        }else{
            return response()->json(['status'=>'2']);
        }
    }
}
