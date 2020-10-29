<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ad_id')->unsigned()->index();
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
            $table->bigInteger('car_brand_id')->unsigned()->index();
            $table->bigInteger('car_model_id')->unsigned()->index();
            $table->string('model_year');
            $table->string('mileage');
            $table->string('transmission');
            $table->string('edition');
            $table->string('fuel_type');
            $table->string('engine_capacity');
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
        Schema::dropIfExists('cars');
    }
}
