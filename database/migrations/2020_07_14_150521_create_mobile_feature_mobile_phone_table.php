<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileFeatureMobilePhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_feature_mobile_phone', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mobile_feature_id')->unsigned()->index();
            $table->bigInteger('mobile_phone_id')->unsigned()->index();
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
        Schema::dropIfExists('mobile_feature_mobile_phone');
    }
}
