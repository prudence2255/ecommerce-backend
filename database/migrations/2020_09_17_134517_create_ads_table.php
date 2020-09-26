<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->bigInteger('parent_category_id')->unsigned()->index();
            $table->bigInteger('child_category_id')->unsigned()->index();
            $table->bigInteger('parent_location_id')->unsigned()->index();
            $table->bigInteger('child_location_id')->unsigned()->index();
            $table->json('images');
            $table->string('price');
            $table->text('description');
            $table->text('title');
            $table->string('condition');
            $table->string('category');
            $table->boolean('negotiable')->nullable();
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
        Schema::dropIfExists('ads');
    }
}
