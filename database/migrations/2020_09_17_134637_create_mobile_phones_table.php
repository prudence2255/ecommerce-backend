<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_phones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ad_id')->unsigned()->index();
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
            $table->bigInteger('mobile_brand_id')->unsigned()->index();
            $table->bigInteger('mobile_model_id')->unsigned()->index();
            $table->string('edition')->nullable();
            $table->json('features')->nullable();
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
        Schema::dropIfExists('mobile_phones');
    }
}
