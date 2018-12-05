<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propertys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid',255);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->string('name',255);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('property_category')->onDelete('cascade');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('property_types')->onDelete('cascade');
            $table->integer('prize')->unsigned();
            $table->string('building_area',255); 
            $table->integer('building_unit_id')->unsigned();
            $table->foreign('building_unit_id')->references('id')->on('property_building_units')->onDelete('cascade');
            $table->string('land_area',255);
            $table->integer('land_unit_id')->unsigned();
            $table->foreign('land_unit_id')->references('id')->on('property_land_units')->onDelete('cascade');
            $table->integer('bedroom')->unsigned();
            $table->integer('bathroom')->unsigned();
	        $table->string('location')->nullable();
            $table->tinyInteger('status')->comment('0-inactive , 1-active')->nullable(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propertys');
    }
}
