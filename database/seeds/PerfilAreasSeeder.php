<?php

use Illuminate\Database\Seeder;
use App\Models\{Perfil,Area};


class PerfilAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Perfil::create(['nombre'=>'Administrador']);
        Perfil::create(['id'=>1,'nombre'=>'Administrador']);
        Perfil::create(['id'=>2,'nombre'=>'Captura']);
        Perfil::create(['id'=>3,'nombre'=>'Cliente']);
        //Datos para area
        Area::create(['id'=>1,'nombre'=>'Informatica']);
        Area::create(['id'=>2,'nombre'=>'Lacteos']);
        Area::create(['id'=>3,'nombre'=>'Hogar']);

    }
}
