<?php

namespace App\Http\Controllers;

use App\Models\Bids;
use Illuminate\Http\Request;

class BidsController extends Controller
{
    public function bids(Request $request){

        $Expected_States = array("accepted", "declined");

        $checkIfDriverIDExist = DB::table('drivers')->where('id', $request->driver_id)->first();

        $checkIfCarIDExist = DB::table('vehicles')->where('id', $request->vehicle_id)->first();

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
            else{

                $userComment = new Bids();
                $userComment->name = $request->input('driver_id');
                $userComment->email = $request->input('vehicle_id');
                $userComment->message = $request->input('bid_status');
                $userComment->save();

                return json_encode([
                    '200'=>'success',
                    'message'=>'Bid Successful'
                ], JSON_PRETTY_PRINT);

                }

    }
}
