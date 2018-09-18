<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailsTable extends Migration
{
    /**  
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_countries_id')->unsigned();
            $table->foreign('user_countries_id')->references('id')->on('user_countries')->onDelete('cascade');
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('country_language')->onDelete('cascade');
            $table->string('name',150)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->text('about_us')->collation('utf8mb4_unicode_ci')->nullable();
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
        Schema::dropIfExists('users_details');
    }
}
