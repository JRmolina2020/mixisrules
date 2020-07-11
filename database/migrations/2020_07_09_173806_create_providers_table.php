<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('company_name', 70)->nullable();
            $table->string('services', 70)->nullable();
            $table->string('landline', 13)->nullable(); //#fijo
            $table->string('banking_entity', 30)->nullable();
            $table->string('account_type', 30)->nullable();
            $table->string('account_number', 30)->nullable();
            $table->foreign('id')->references('id')->on('people')->onDelete('cascade');
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
        Schema::dropIfExists('providers');
    }
}