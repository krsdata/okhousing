<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeighbourhood4PropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Neighbourhood4Property', function (Blueprint $table) {
            $table->increments('id');
            $table->float('kilometer', 8, 2);
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('propertys')->onDelete('cascade');
            $table->integer('neighbourhood_id')->unsigned();
            $table->foreign('neighbourhood_id')->references('id')->on('property_neighborhood')->onDelete('cascade');
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
        Schema::dropIfExists('Neighbourhood4Property');
    }
}
