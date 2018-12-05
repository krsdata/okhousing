<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('builders', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('builder_name',255)->nullable(false);
            $table->string('mobile',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->smallInteger('established_year')->nullable();
            $table->string('builder_logo',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('street_name',255)->nullable(false)->nullable();
            $table->string('post_code',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('location',255)->nullable(false)->nullable();
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
        Schema::dropIfExists('Builders');
    }
}
