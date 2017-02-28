<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CompanyUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('name');
            $table->integer('company_type_id')->nullable()->unsigned();
            $table->integer('latitude')->nullable();
            $table->integer('longitude')->nullable();
            $table->integer('city_id')->nullable()->unsigned();
            $table->integer('state_id')->nullable()->unsigned();
            $table->integer('country_id')->nullable()->unsigned();
            $table->integer('zip_code')->nullable();
            $table->integer('phone_num')->nullable();
            $table->string('address')->nullable();
            $table->integer('rating')->nullable();
            $table->string('email')->nullable();
            $table->string('deals')->nullable();
            $table->string('details')->nullable();
            $table->string('logo')->nullable();
            $table->string('site')->nullable();
            $table->integer('site_id')->nullable()->unsigned();
            $table->integer('map_address')->nullable()->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
