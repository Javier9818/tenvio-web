<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Contrato;
use App\Empresa;
use App\Ciudad;
use App\TipoNegocio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class EmpresaController extends Controller
{

    public function activateEmpresa(Request $request){
        DB::transaction(function () use ($request){
            $ciudad = ($request->ciudad == null)? (Ciudad::create(["nombre" => ucwords(strtolower($request->ciudadCreate)), "distrito_id" => $request->distrito]))->id : $request->ciudad;
            Contrato::create([
                "empresa_id" => $request->id,
                "estado" => Contrato::$CONTRATO_VIGENTE,
                "plan_id" => 1,
                "plan_monto" => 0.0,
                "fecha_vencimiento" => Carbon::now()->addDays(30)
            ]);
            Empresa::where('id', $request->id)->update(['estado' => 'ACTIVO', 'ciudad_id' => $ciudad]);
        });

        return response()->json(["message" => "Actualización exitosa", "empresa" => $request->id]);
    }

    public function setEmpresa(Request $request){
        DB::transaction(function () use ($request){
            $ciudad = ($request->ciudad == null)? (Ciudad::create(["nombre" => ucwords(strtolower($request->ciudadCreate)), "distrito_id" => $request->distrito]))->id : $request->ciudad;
            $usernameEmpresa = Empresa::crearNombreUnico(str_replace(' ', '', strtolower($request->nombre)));

            $empresa = Empresa::create([
                "ruc" => $request->ruc,
                "nombre" => $request->nombre,
                "descripcion" => $request->descripcion,
                "telefono" => $request->telefono,
                "celular" => $request->celular,
                "direccion" => $request->direccion,
                "ciudad_id" => $ciudad,
                "nombre_unico" => $usernameEmpresa
            ]);

            Contrato::create([
                "empresa_id" => $empresa->id,
                "estado" => Contrato::$CONTRATO_VIGENTE,
                "plan_id" => 1,
                "plan_monto" => 0.0,
                "fecha_vencimiento" => Carbon::now()->addDays(30)
            ]);

            foreach ($request->categorias as $key => $value) {
                DB::insert('insert into categoria_empresa (empresa_id, categoria_id) values (?, ?)', [$empresa->id, $value['value']]);
            }

            DB::insert('insert into tipo_entrega_empresas(empresa_id, tipo_entrega_id) values (?, ?)', [$empresa->id, 1]);
            // DB::insert('insert into tipo_entrega_empresas(empresa_id, tipo_entrega_id) values (?, ?)', [$empresa->id, 2]);

            // Contrato::create(["empresa_id" => $empresa->id,"estado" => 'PRUEBA']);
        });


        return response()->json(["message" => "Registro exitoso"], 200);
    }

    public function preRegisterEmpresa(Request $request){
        DB::transaction(function () use ($request){
            $usernameEmpresa = Empresa::crearNombreUnico(str_replace(' ', '', strtolower($request->nombre)));
            $empresa = Empresa::create([
                "ruc" => $request->ruc ?? null,
                "nombre" => $request->nombre,
                "descripcion" => $request->descripcion,
                "telefono" => $request->telefono,
                "celular" => $request->celular,
                "direccion" => $request->direccion,
                "ciudad_id" => $request->distrito,
                "nombre_unico" => $usernameEmpresa,
                "estado" => "SOLICITADO"
            ]);

            foreach ($request->categorias as $key => $value) {
                DB::insert('insert into categoria_empresa (empresa_id, categoria_id) values (?, ?)', [$empresa->id, $value['value']]);
            }

            DB::insert('insert into tipo_entrega_empresas(empresa_id, tipo_entrega_id) values (?, ?)', [$empresa->id, 1]);
            DB::insert('insert into tipo_entrega_empresas(empresa_id, tipo_entrega_id, estado) values (?, ?, ?)', [$empresa->id, 2, false]);

        });
        // Mail::to($request->email)->send(new SendCargo($request->persona, $url, $request->email, $mensaje));
        return response()->json(["message" => "Registro exitoso"], 200);

    }

    /** ======== */

    public function updateEmpresa(Request $request, $empresa){
        $empresa = Empresa::find($empresa);
        $empresa->nombre = $request->nombre;
        $empresa->ruc =  $request->ruc;
        $empresa->descripcion = $request->descripcion;
        $empresa->telefono = $request->telefono;
        $empresa->celular = $request->celular;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad_id = $request->ciudad_id;

        DB::transaction(function () use ($empresa, $request){
            $empresa->save();
            DB::table('categoria_empresa')->where('empresa_id', $empresa->id)->delete();
            foreach ($request->categorias as $key => $value) {
                DB::insert('insert into categoria_empresa (empresa_id, categoria_id) values (?, ?)', [$empresa->id, $value['value']]);
            }
        });

        return response()->json(["message" => "Actualización exitosa"], 200);
    }

    public function updateFoto(Request $request, $empresa){
        $empresa = Empresa::find($empresa);

        $image = substr($request->image, strpos($request->image, ',') + 1);
        $image = base64_decode($image);
        //return $image;

        if($empresa->foto != '') $res = Empresa::setImagen($image, $empresa->foto);
        else $res = Empresa::setImagen($image);

        if($res !== false){
            $empresa->foto = $res;
            $empresa->save();
            return response()->json(["message" => "Actualización exitosa", "foto" => $res], 200);
        }else{
            return response()->json(["message" => "Error en actualización"], 500);
        }

    }

    public function verEmpresa(){
        $idempresa = session('empresa');
        // $permisos = Auth::user()->permisoUser;
        // return dd($permisos[5]->descripcion);
        $empresa = DB::select('select e.*, ci.nombre as ciudad, ci.distrito_id as distrito,
                                GROUP_CONCAT(ce.categoria_id) as categorias,
                                GROUP_CONCAT(ca.descripcion) as categoriasdes,
                                tn.id as tiponegocio,
                                tn.descripcion as tiponegociodes
                                from empresas e
                                inner join ciudad ci on ci.id = e.ciudad_id
                                inner join categoria_empresa ce on ce.empresa_id = e.id
                                inner join categorias ca on ca.id = ce.categoria_id
                                inner join tipo_negocio tn on tn.id = ca.tipo_negocio_id
                                where e.id = ?
                                group by e.id', [$idempresa]);
        $ciudades = Ciudad::where('distrito_id', $empresa[0]->distrito)->get();
        $categorias = DB::table('categorias')->selectRaw('id as value, descripcion as text')
                        ->where('tipo_negocio_id','=',$empresa[0]->tiponegocio)->get();
        $tiponegocios = TipoNegocio::all();

        return view('admin.inicio', ["empresa" => $empresa[0], "ciudades" => $ciudades, "tiponegocios" => $tiponegocios, "categorias" => $categorias]);
    }

    public function listarEmpresas(){
        $empresas = Empresa::all();
        return view('front.listEmpresa',compact('empresas'));
    }

    public function tiposEntrega($empresa){
        $tipos = DB::select('select * from tipo_entrega_empresas te
                            inner join tipo_entregas t on te.tipo_entrega_id = t.id
                            where te.empresa_id = ?', [$empresa]);
        return response()->json(["tipos" => $tipos], 200);
    }

    public function updateTipoEntrega(Request $request){
        DB::update('update tipo_entrega_empresas set estado = ? where tipo_entrega_id = ? and empresa_id = ?', [$request->estado, $request->tipo_entrega_id, $request->empresa]);
    }

    public function nombreUnico($idempresa){
        $empresa = Empresa::find($idempresa);
        return response()->json(["nombreUnico" => $empresa->nombre_unico]);
    }

    public function updateNombreUnico(Request $request){
        $empresa = Empresa::find($request->empresa);
        $empresa->nombre_unico = $request->nombreUnico;
        $empresa->save();
        return response()->json(["Message" => 'Actualización exitosa']);
    }

    public function validaNombreUnico(Request $request){
        $empresas = DB::table('empresas')->where('nombre_unico','=',$request->nombreUnico)->get();
        return (count($empresas)>0) ? response()->json(["message" => true]) : response()->json(["message"=>false]);
    }

    public function geoPosition(Request $request, $empresa){
        $empresa = Empresa::find($empresa)->update([
            "latitud" => $request->lat,
            "longitud" => $request->lng
        ]);

        return response()->json(["message" => "Registro exitoso"]);
    }

    public function search(Request $request)
    {
        return DB::table('empresas')
        ->select('empresas.nombre','empresas.ruc','empresas.celular','empresas.id' )
        ->where(
            [
                [$request->get('column'),'=',$request->get('text_search')]
            ]
        )
        ->get();

    }

}
