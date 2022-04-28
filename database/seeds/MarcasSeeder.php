<?php

use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(\App\Models\Marca::class)->times(50)->create();
    }
}
