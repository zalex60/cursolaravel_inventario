<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerfilIdUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->foreignId('perfil_id')->default(1)->constrained('perfiles');
            $table->foreignId('area_id')->default(1)->constrained('areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropForeign('users_perfil_id_foreign');
            $table->dropcolumn('perfil_id');
            $table->dropForeign('users_area_id_foreign');
            $table->dropcolumn('area_id');
        });
    }
}
