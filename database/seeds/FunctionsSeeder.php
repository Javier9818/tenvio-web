<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunctionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS F_DISTANCE');
        DB::unprepared('CREATE FUNCTION F_DISTANCE(LATITUD_1 FLOAT, LONGITUD_1 FLOAT, LATITUD_2 FLOAT, LONGITUD_2 FLOAT) RETURNS FLOAT
        BEGIN
        DECLARE salida FLOAT;
        SET salida = (acos(sin(radians(LATITUD_1)) * sin(radians(LATITUD_2)) +
                        cos(radians(LATITUD_1)) * cos(radians(LATITUD_2)) *
                        cos(radians(LONGITUD_1) - radians(LONGITUD_2))) * 6378);
        RETURN salida;
        END');
    }
}
