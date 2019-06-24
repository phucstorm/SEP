<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class SearchController extends Controller
{
    //

    public function search(Request $request){
        $event = Event::where('event_code', '=', $request->get('room'))->firstOrFail();
        if($event->setting_join == 1){
            return view('room', compact('event', $event));
        }else{
            return "You don't have a permission to join this room";
        }
    }

    public function getQR(Request $request){
        // $qrcode = new BaconQrCodeGenerator;
        
        $code = $request->event_code;
        $link = 'http://localhost:8000/room?room=';
        $total =  $link.''.$code;
        return view('event.qr')-> with('total', $total);
    }
}
