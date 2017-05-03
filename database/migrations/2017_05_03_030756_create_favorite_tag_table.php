<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('favorite_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('favorite_id')->references('id')->on('favorites');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('favorite_tag');
    }
}
