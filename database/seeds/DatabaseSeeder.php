<?php

use App\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [1, 'NEGOCIO']);
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [2, 'MENU']);
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [3, 'PEDIDOS']);
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [4, 'TRANSPORTE']);
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [5, 'USUARIO']);

        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [1, 'POLLERIA']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [2, 'CHIFA']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [3, 'RESTAURANT']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [4, 'PIZZERIA']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [5, 'FUENTE DE SODA']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [6, 'RESPOTERIA']);

        DB::insert('insert into tipos (id, descripcion) values (?, ?)', [1, 'DELIVERY']);
        DB::insert('insert into tipos (id, descripcion) values (?, ?)', [2, 'RECEPCION']);

        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [1, 'GERENTE']);
        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [2, 'COCINERO']);
        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [3, 'AYUDANTE DE COCINA']);
        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [4, 'ADMINISTRADOR']);
        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [5, 'PERSONAL DE NEGOCIO']);
        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [6, 'PERSONAL DE TRANSPORTE']);


        $person = Persona::create([
            "nombres" => "Javier",
            "appaterno" => "Briceño",
            "apmaterno" => "Montaño",
            "celular" => "981559813",
            "direccion" => "Urb.Las Gardenias Maz F. Lte 23",
            "dni" => "72764269"
        ]);

        DB::insert('insert into users (username, email, password, persona_id, isAdmin) values (?, ?, ?, ?, ?)', ['Javier98', 'jbriceno@unitru.edu.pe','$2y$10$bYFb1csH9VFCm43kVtYN.uDvXvH4nAkk4oSBu2wsrk68AsUf00iP2',$person->id,true]);

    }
}
