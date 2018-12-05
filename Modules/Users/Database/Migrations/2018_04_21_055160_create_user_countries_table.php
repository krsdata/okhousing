<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_countries', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('mobile_number')->nullable(); 
            $table->integer('mobile_otp')->nullable();  
            $table->timestamp('mobile_otp_sent_date_time')->nullable();
            $table->integer('mobile_verified')->comment('0-not verified , 1-verified')->nullable(); 
            $table->timestamp('mobile_verified_date_time')->nullable();
            $table->string('mobile_verified_ip',225)->nullable();
            $table->string('location',225)->nullable();
            $table->string('latitude',225)->nullable();
            $table->string('longitude',225)->nullable();
            $table->tinyInteger('country_verified')->comment('0-country not verified by ok4homes , 1-country verified by ok4homes')->nullable();
            $table->string('created_ip',225)->nullable(false);
            $table->string('is_admin',225)->default(0)->comment('0-not admin , 1-admin')->nullable(false);
            $table->integer('admin_id')->nullable(); 
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
        Schema::dropIfExists('user_countries');
    }
}
