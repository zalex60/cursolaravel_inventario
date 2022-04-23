<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'name'=>'Alex',
        'email'=>'alex@alex.com',
        'perfil_id'=>1,
        'area_id'=>1,
        'password'=>bcrypt('alex'),
        ]);
    }
}
