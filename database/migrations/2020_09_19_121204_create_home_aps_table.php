<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeApsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_aps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ad_id')->unsigned()->index();
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
            $table->string('item_type');
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
        Schema::dropIfExists('home_aps');
    }
}
