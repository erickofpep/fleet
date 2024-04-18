<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarOwnersLoginController extends Controller
{
    public function login(Request $request){

   if( empty($request->driver_phone_number) ||  $request->driver_phone_number ){
    return json_encode([
        '101'=>'error',
        'message'=>'Phone number is required'
    ], JSON_PRETTY_PRINT);

    }
    elseif(DB::table('users')->where('phone_number', $request->driver_phone_number)->first()->count() == 0){

        return json_encode([
            '101'=>'error',
            'message'=>'Phone number is required'
        ], JSON_PRETTY_PRINT);

    }
   else{

    return json_encode([
        '200'=>'success',
        'message'=>'Login Successful'
    ], JSON_PRETTY_PRINT);

    }


   }


}
