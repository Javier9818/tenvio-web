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
            "precio" => 0.0
        ]);

        Plan::create([
            "nombre" => "EMPRENDEDOR",
            "descripcion" => "Plan básico emprendedor",
            "precio" => 10.0
        ]);

        Plan::create([
            "nombre" => "MICRO EMPRESA",
            "descripcion" => "Plan microempresa",
            "precio" => 30.0
        ]);

        Plan::create([
            "nombre" => "EMPRESARIAL",
            "descripcion" => "Plan empresarial",
            "precio" => 50.0
        ]);

        Plan::create([
            "nombre" => "EMPRESARIAL PRO",
            "descripcion" => "Plan empresarial pro",
            "precio" => 80.0
        ]);
    }
}
