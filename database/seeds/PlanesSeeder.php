<?php

use App\Plan;
use Illuminate\Database\Seeder;


class PlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            "nombre" => "BÁSICO",
            "descripcion" => "Plan básico gratuito",
            "precio" => 0.0,
			"cantidad_pedidos" => 100,
			"tipo" => "PLAN"
        ]);

        Plan::create([
            "nombre" => "EMPRENDEDOR",
            "descripcion" => "Plan básico emprendedor",
            "precio" => 10.0,
			"cantidad_pedidos" => 200,
			"tipo" => "PLAN"
        ]);

        Plan::create([
            "nombre" => "MICRO EMPRESA",
            "descripcion" => "Plan microempresa",
            "precio" => 30.0,
			"cantidad_pedidos" => 400,
			"tipo" => "PLAN"
        ]);

        Plan::create([
            "nombre" => "EMPRESARIAL",
            "descripcion" => "Plan empresarial",
            "precio" => 50.0,
			"cantidad_pedidos" => 800,
			"tipo" => "PLAN"
        ]);

        Plan::create([
            "nombre" => "EMPRESARIAL PRO",
            "descripcion" => "Plan empresarial pro",
            "precio" => 80.0,
			"cantidad_pedidos" => 1600,
			"tipo" => "PLAN"
        ]);

        Plan::create([
            "nombre" => "PAQUETE 100 PEDIDOS",
            "descripcion" => "Añade 100 pedidos más a tu plan",
            "precio" => 5.0,
			"cantidad_pedidos" => 100,
			"tipo" => "EXTENSIÓN"
        ]);

        Plan::create([
            "nombre" => "PAQUETE 200 PEDIDOS",
            "descripcion" => "Añade 200 pedidos más a tu plan",
            "precio" => 10.0,
			"cantidad_pedidos" => 200,
			"tipo" => "EXTENSIÓN"
        ]);

        Plan::create([
            "nombre" => "PAQUETE 300 PEDIDOS",
            "descripcion" => "Añade 300 pedidos más a tu plan",
            "precio" => 15.0,
			"cantidad_pedidos" => 300,
			"tipo" => "EXTENSIÓN"
        ]);

        Plan::create([
            "nombre" => "PAQUETE 400 PEDIDOS",
            "descripcion" => "Añade 400 pedidos más a tu plan",
            "precio" => 20.0,
			"cantidad_pedidos" => 400,
			"tipo" => "EXTENSIÓN"
        ]);

        Plan::create([
            "nombre" => "PAQUETE 500 PEDIDOS",
            "descripcion" => "Añade 500 pedidos más a tu plan",
            "precio" => 25.0,
			"cantidad_pedidos" => 500,
			"tipo" => "EXTENSIÓN"
        ]);
        
    }
}
