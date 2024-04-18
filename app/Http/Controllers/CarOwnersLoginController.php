<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarOwnersLoginController extends Controller
{
    public function login(Request $request){

$checkIfLoginDetailsExist = DB::table('users')->where('email', $request->email)->where('password', $request->password)->first();


   if( empty($request->email) || $request->email=='' ){
    return json_encode([
        '500'=>'error',
        'message'=>'email is required'
    ], JSON_PRETTY_PRINT);

    }
    elseif( empty($request->email) || $request->email=='' ){
        return json_encode([
            '500'=>'error',
            'message'=>'invalid email'
        ], JSON_PRETTY_PRINT);

    }
    elseif (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {

        return json_encode([
            '500'=>'error',
            'message'=>'Invalid email format'
        ], JSON_PRETTY_PRINT);

    }
    elseif( empty($request->password) || $request->password =='' ){
    return json_encode([
        '500'=>'error',
        'message'=>'password is required'
    ], JSON_PRETTY_PRINT);

    }
    elseif(!$checkIfLoginDetailsExist){

        return json_encode([
            '500'=>'error',
            'message'=>'login details not found'
        ], JSON_PRETTY_PRINT);

    }
   else{

    return json_encode([
        '200'=>'success',
        'message'=>'Login Successful',
        'client_id'=>$checkIfLoginDetailsExist->id
    ], JSON_PRETTY_PRINT);

    }

   }

}
