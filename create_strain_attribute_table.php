<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrainAttributeTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strain_attribute', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('strain_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->integer('value');
            $table->foreign('strain_id')->references('strain_id')->on('strains')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('attribute_id')->references('strain_attribute_id')->on('strain_attributes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('strain_attribute');
    }

}
