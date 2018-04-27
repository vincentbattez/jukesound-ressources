<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jukesound_RES_items', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('id_category');
            $table->foreign('id_category')->references('id')->on('jukesound_RES_categories');
            
            $table->string('name');
            $table->string('slug');
            $table->integer('quantity');
            $table->integer('quantity_jukebox');
            $table->integer('quantity_buy');
            $table->decimal('price');
            $table->longText('url');
            $table->string('image');
            
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
        Schema::dropIfExists('jukesound_RES_items');
    }
}
