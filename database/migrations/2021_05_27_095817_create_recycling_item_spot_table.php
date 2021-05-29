<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecyclingItemSpotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recycling_item_spot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('spot_id')->unsigned();
            $table->bigInteger('recycling_item_id')->unsigned();
            $table->timestamps();

            $table->foreign('spot_id')
                  ->references('id')
                  ->on('spots')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recycling_item_spot');
    }
}
