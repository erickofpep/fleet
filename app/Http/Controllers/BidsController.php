<?php

namespace App\Http\Controllers;

use App\Models\Bids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BidsController extends Controller
{
    public function bids(Request $request){

    $Expected_States = array("accepted", "declined");

if( Schema::hasTable('driver') ){
    $checkIfDriverIDExist = DB::table('driver')->where('id', $request->driver_id)->first();
}
else{
    return json_encode([
        '500'=>'error',
        'message'=>'Drivers table does not exist'
    ], JSON_PRETTY_PRINT);
}

if( Schema::hasTable('vehicle') ){
    $checkIfCarIDExist = DB::table('vehicle')->where('id', $request->vehicle_id)->first();
}
else{

    return json_encode([
        '500'=>'error',
        'message'=>'Vehicles table does not exist'
    ], JSON_PRETTY_PRINT);
}

$checkIfBidExists=DB::table('bids')->where('driver_id', $request->driver_id)->where('vehicle_id', $request->vehicle_id)->first();


        if( empty($request->driver_id) || $request->driver_id=='' ){
            return json_encode([
                '500'=>'error',
                'message'=>'driver_id is required'
            ], JSON_PRETTY_PRINT);

            }
            elseif( empty($request->vehicle_id) || $request->vehicle_id=='' ){
                return json_encode([
                    '500'=>'error',
                    'message'=>'vehicle_id is required'
                ], JSON_PRETTY_PRINT);

            }
            elseif( !empty($request->bid_status) && ( !array_key_exists('accepted', $Expected_States) || !array_key_exists('declined', $Expected_States) ) ){
                return json_encode([
                    '500'=>'error',
                    'message'=>'bid_status should be either accepted or declined'
                ], JSON_PRETTY_PRINT);

            }
            elseif(!$checkIfDriverIDExist){

                return json_encode([
                    '500'=>'error',
                    'message'=>'driver_id not found'
                ], JSON_PRETTY_PRINT);

            }
            elseif(!$checkIfCarIDExist){

                return json_encode([
                    '500'=>'error',
                    'message'=>'vehicle_id not found'
                ], JSON_PRETTY_PRINT);

            }
            // /*
            elseif( $checkIfBidExists && $checkIfBidExists->bid_status !='expired' ){

                return json_encode([
                    '500'=>'error',
                    'message'=>'duplicate bid'
                ], JSON_PRETTY_PRINT);

            }
            // */
            else{

                $userComment = new Bids();
                $userComment->driver_id = $request->input('driver_id');
                $userComment->vehicle_id = $request->input('vehicle_id');
                $userComment->bid_status = $request->input('bid_status');
                $userComment->save();

                return json_encode([
                    '200'=>'success',
                    'message'=>'Bid Successful'
                ], JSON_PRETTY_PRINT);

                }

    }
}
