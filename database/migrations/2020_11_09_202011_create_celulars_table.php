<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCelularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celulares', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned();

            $table->timestamps();
            $table->string('imei');
            $table->string('imei2')->nullable();
            $table->string('marca');
            $table->string('modelo');
            $table->softDeletes();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("celulares", function ($table) {
            $table->dropSoftDeletes();
        });
    }
}
