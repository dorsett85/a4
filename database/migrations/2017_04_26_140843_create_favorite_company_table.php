<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('favorites', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();
            $table->string('ticker');
            $table->string('company_name');
            $table->string('stock_exchange');
            $table->text('short_description');
            $table->string('company_url');
            $table->string('hq_state');
            $table->string('sector');
            $table->string('industry_category');
            $table->string('industry_group');
            $table->string('strategy')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('favorites');
    }
}
