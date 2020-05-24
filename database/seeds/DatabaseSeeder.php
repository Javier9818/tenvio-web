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
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [1, 'Gestión de personal']);
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [2, 'Gestión de contabilidad']);
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [3, 'Gestión de pedidos']);
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [4, 'Gestión de productos']);
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [5, 'Repartidor delivery']);
        DB::insert('insert into permisos (id, descripcion) values (?, ?)', [6, 'Gestión de datos de negocio']);

        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [1, 'POLLERIA']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [2, 'CHIFA']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [3, 'RESTAURANT']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [4, 'PIZZERIA']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [5, 'FUENTE DE SODA']);
        DB::insert('insert into categorias (id, descripcion) values (?, ?)', [6, 'RESPOTERIA']);

        DB::insert('insert into tipo_entregas (id, nombre) values (?, ?)', [1, 'DELIVERY']);
        DB::insert('insert into tipo_entregas (id, nombre) values (?, ?)', [2, 'RECEPCIÓN EN LOCAL']);

        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [1, 'GERENTE']);
        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [2, 'ADMINISTRADOR']);
        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [3, 'CONTADOR']);
        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [4, 'PERSONAL DE NEGOCIO']);
        DB::insert('insert into cargos (id, descripcion) values (?, ?)', [5, 'PERSONAL DE TRANSPORTE']);


        $person = Persona::create([
            "nombres" => "Javier",
            "appaterno" => "Briceño",
            "apmaterno" => "Montaño",
            "celular" => "981559813",
            "direccion" => "Urb.Las Gardenias Maz F. Lte 23",
            "dni" => "72764269"
        ]);

		$person2 = Persona::create([
            "nombres" => "Jairo",
            "appaterno" => "Navez",
            "apmaterno" => "Aroca",
            "celular" => "956504624",
            "direccion" => "Manuel Ubalde #822",
            "dni" => "72409948"
        ]);


        DB::insert('insert into users (username, email, password, persona_id, isAdmin) values (?, ?, ?, ?, ?)',
			[
				'Javier98',
				'jbriceno@unitru.edu.pe',
				'$2y$10$bYFb1csH9VFCm43kVtYN.uDvXvH4nAkk4oSBu2wsrk68AsUf00iP2'
				,$person->id,
				true
			]
		);

        DB::insert('insert into users (username, email, password, persona_id, isAdmin) values (?, ?, ?, ?, ?)',
			[
				'jnavez',
				'jnavez@unitru.edu.pe',
				'$2y$10$bYFb1csH9VFCm43kVtYN.uDvXvH4nAkk4oSBu2wsrk68AsUf00iP2'//123456789
				,$person2->id,
				true
			]
		);

    }
}
