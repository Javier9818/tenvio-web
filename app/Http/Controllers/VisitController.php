<?php

namespace App\Http\Controllers;

use App\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function show(){
        $visits = Visit::all();
        $array = [];
        $index = 0;
        // return response()->json($visits);
        foreach ($visits as $key => $value) {
            $time = 0;
            $monto = 0;
            $array = $value['navigation'];
            foreach ($array as $key_nav => $value_nav) {
                $time =  $time + $value_nav['sessionTime'];
                $monto = $monto + $value_nav['moneyInvested'];
            }
            if($time>0) { //$monto < 100 && $monto > 0 && $time>0
                array_push($array, json_decode('{"index":"'.$index.'", "time":"'.($time/10000000).'", "moneyInvested":"'.$monto.'"}'));
                $index = $index +1;
            }
            
        }
        return response()->json($array);
    }
   
    public function store(Request $request){
        $visit = Visit::firstOrCreate(['id' => $request->id]);

        $navigation = $visit->navigation ?? [];
        array_push($navigation, $request->except(['id', 'location', 'device', 'idEmpresa']));

        $visit->location = $request->location ?? [];
        $visit->navigation = $navigation;
        $visit->device = $request->device ?? null;
        $visit->idEmpresa = $request->idEmpresa ?? null;
        $visit->save();

        return response()->json(["message" => "ok", "visit" => $visit]);
    }
}
