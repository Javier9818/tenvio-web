<?php

use Illuminate\Database\Seeder;
use App\Categoria;
use App\TipoNegocio;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoNegocio::create(["descripcion" => 'RESTAURANTE','state'=>1,"icon"=>"lni lni-dinner"]);
        TipoNegocio::create(["descripcion" => 'RESPOTERIA','state'=>1,"icon"=>"lni lni-cake"]);
        TipoNegocio::create(["descripcion" => 'BODEGA','state'=>1,"icon"=>"lni lni-restaurant"]);
        TipoNegocio::create(["descripcion" => 'TIENDA DE ROPA','state'=>1,"icon"=>"lni lni-shopping-basket"]);
        TipoNegocio::create(["descripcion" => 'TIENDA DE ELECTRÓNICA','state'=>1,"icon"=>"lni lni-laptop-phone"]);
        TipoNegocio::create(["descripcion" => 'TIENDA DE ACCESORIOS','state'=>1,"icon"=>"lni lni-game"]);
        TipoNegocio::create(["descripcion" => 'LIBRERIA','state'=>1,"icon"=>"lni lni-book"]);

        Categoria::create(["descripcion" => "POLLERIA", "tipo_negocio_id" => 1,"icon"=>"drumstick-bite",'state'=>1]);
        Categoria::create(["descripcion" => "CHIFA", "tipo_negocio_id" => 1,"icon"=>"salad",'state'=>1]);
        Categoria::create(["descripcion" => "MENÚS EN GENERAL", "tipo_negocio_id" => 1,"icon"=>"utensils",'state'=>1]);
        Categoria::create(["descripcion" => "FUENTE DE SODA", "tipo_negocio_id" => 1,"icon"=>"hamburger",'state'=>1]);

        Categoria::create(["descripcion" => "REPOSTERIA", "tipo_negocio_id" => 2,"icon"=>"cookie-bite",'state'=>1]);
        Categoria::create(["descripcion" => "BODEGA", "tipo_negocio_id" => 3,"icon"=>"store",'state'=>1]);

        Categoria::create(["descripcion" => "ROPA HOMBRE", "tipo_negocio_id" => 4,"icon"=>"tshirt",'state'=>1]);
        Categoria::create(["descripcion" => "ROPA MUJER", "tipo_negocio_id" => 4,"icon"=>"venus",'state'=>1]);
        Categoria::create(["descripcion" => "ROPA NIÑOS", "tipo_negocio_id" => 4,"icon"=>"socks",'state'=>1]);

        Categoria::create(["descripcion" => "APARATOS ELECTRÓNICOS EN GENERAL", "tipo_negocio_id" => 5,"icon"=>"laptop",'state'=>1]);

        Categoria::create(["descripcion" => "REGALOS", "tipo_negocio_id" => 6,"icon"=>"gifts",'state'=>1]);
        Categoria::create(["descripcion" => "ACCESORIOS HOMBRE", "tipo_negocio_id" => 6,"icon"=>"male",'state'=>1]);
        Categoria::create(["descripcion" => "ACCESORIOS MUJER", "tipo_negocio_id" => 6,"icon"=>"female",'state'=>1]);
        Categoria::create(["descripcion" => "ACCESORIOS NIÑOS", "tipo_negocio_id" => 6,"icon"=>"child",'state'=>1]);

        Categoria::create(["descripcion" => "LIBRERIA", "tipo_negocio_id" => 7,"icon"=>"book",'state'=>1]);
    }
}
