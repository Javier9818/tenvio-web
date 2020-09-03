<?php

namespace App\Http\Controllers;

use App\tipopago;
use Hamcrest\Type\IsString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipopagoController extends Controller
{
    public function tiposPago($empresa){
        $tipos = DB::select('select * from tipopago t
                            inner join tipopago_empresa te on te.tipopago_id = t.id
                            where te.empresa_id = ?', [$empresa]);
        return response()->json(["tipos" => $tipos], 200);
    }
    public function tiposPagoFront($empresa){
        $tipos = DB::select('select * from tipopago t
                            inner join tipopago_empresa te on te.tipopago_id = t.id
                            where te.empresa_id = ? and te.estado=1', [$empresa]);
        return response()->json(["tipos" => $tipos], 200);
    }
    public function updateTipoPago(Request $request){
        $pago= $request->get('pago'); 
        $idempresa= $request->get('idempresa');
        if(!is_string($pago['code'])){
            $fotosubida = $pago['code']??[];
            if (count($fotosubida) == 1){
                $sesubiofoto = true;
                $fotosubida = $fotosubida[0]['upload']['data'];
            }
        }else{
            $fotosubida=$pago['code'];
        }       
        $sesubiofoto = false;
        if ($sesubiofoto == true)
            ExtrasController::moverFotoPagos($fotosubida);
       
        DB::update('update tipopago_empresa set estado = ?, code= ?, number= ? where tipopago_id = ? and empresa_id = ?', [$pago['estado'], $fotosubida,$pago['number'],$pago['tipopago_id'], $idempresa]);
         
    }
}
