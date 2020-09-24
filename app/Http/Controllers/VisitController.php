<?php

namespace App\Http\Controllers;

use App\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
   
    public function store(Request $request){
        $visit = Visit::firstOrCreate(['id' => $request->id]);

        $navigation = $visit->navigation ?? [];
        array_push($navigation, $request->except('id'));

        $visit->navigation = $navigation;
        $visit->save();

        return response()->json(["message" => "ok", "visit" => $visit]);
    }
}
