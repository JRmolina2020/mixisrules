<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');
            $table->integer('type_person')->default(2); //2 = natural , 1//juridica
            $table->integer('regimen_type')->default(49); //49 = no iva, 48//si iva
            $table->boolean('responsible_iva')->default(0);
            $table->string('business_name', 150)->nullable(); //nombre del negocio
            $table->string('tributary_information')->default('ZZZ');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}