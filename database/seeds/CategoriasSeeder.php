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
        TipoNegocio::create(["descripcion" => 'RESTAURANTE']);
        TipoNegocio::create(["descripcion" => 'RESPOTERIA']);
        TipoNegocio::create(["descripcion" => 'BODEGA']);
        TipoNegocio::create(["descripcion" => 'TIENDA DE ROPA']);
        TipoNegocio::create(["descripcion" => 'TIENDA DE ELECTRÓNICA']);
        TipoNegocio::create(["descripcion" => 'TIENDA DE ACCESORIOS']);
        TipoNegocio::create(["descripcion" => 'LIBRERIA']);

        Categoria::create(["descripcion" => "POLLERIA", "tipo_negocio_id" => 1]);
        Categoria::create(["descripcion" => "CHIFA", "tipo_negocio_id" => 1]);
        Categoria::create(["descripcion" => "MENÚS EN GENERAL", "tipo_negocio_id" => 1]);
        Categoria::create(["descripcion" => "FUENTE DE SODA", "tipo_negocio_id" => 1]);

        Categoria::create(["descripcion" => "REPOSTERIA", "tipo_negocio_id" => 2]);
        Categoria::create(["descripcion" => "BODEGA", "tipo_negocio_id" => 3]);

        Categoria::create(["descripcion" => "ROPA HOMBRE", "tipo_negocio_id" => 4]);
        Categoria::create(["descripcion" => "ROPA MUJER", "tipo_negocio_id" => 4]);
        Categoria::create(["descripcion" => "ROPA NIÑOS", "tipo_negocio_id" => 4]);

        Categoria::create(["descripcion" => "APARATOS ELECTRÓNICOS EN GENERAL", "tipo_negocio_id" => 5]);

        Categoria::create(["descripcion" => "REGALOS", "tipo_negocio_id" => 6]);
        Categoria::create(["descripcion" => "ACCESORIOS HOMBRE", "tipo_negocio_id" => 6]);
        Categoria::create(["descripcion" => "ACCESORIOS MUJER", "tipo_negocio_id" => 6]);
        Categoria::create(["descripcion" => "ACCESORIOS NIÑOS", "tipo_negocio_id" => 6]);

        Categoria::create(["descripcion" => "LIBRERIA", "tipo_negocio_id" => 7]);
    }
}
