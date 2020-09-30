<?php

namespace App\Http\Controllers;

use App\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function show(){
        $visits = Visit::all();
        $array = [];

        foreach ($visits as $key => $value) {
            $time = 0;
            $monto = 0;
            foreach ($value['navigation'] as $key_nav => $value_nav) {
                $time =  $time + $value_nav['sessionTime'];
                $monto = $monto + $value_nav['moneyInvested'];
            }
            array_push($array, json_decode('{"time":"'.$time.'", "moneyInvested":"'.$monto.'"}'));
        }
        return response()->json($array);
    }
   
    public function store(Request $request){
        $visit = Visit::firstOrCreate(['id' => $request->id]);

        $navigation = $visit->navigation ?? [];
        array_push($navigation, $request->except(['id', 'location']));

        $visit->location = $request->location ?? [];
        $visit->navigation = $navigation;
        $visit->save();

        return response()->json(["message" => "ok", "visit" => $visit]);
    }
}
