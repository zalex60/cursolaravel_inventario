<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fecha_adquisicion');
            $table->string('serie');
            $table->text('descripcion');
            $table->double('costo');
            $table->integer('estado');
            $table->integer('cantidad');
            $table->string('folio');
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('area_id')->constrained('areas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
