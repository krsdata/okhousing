<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('email',255)->nullable(false);
            $table->integer('email_token')->nullable();
            $table->timestamp('email_sent_date_time_for_email_verification')->nullable();
            $table->tinyInteger('email_sent_for_email_verification')->comment('0-not sent for email verification , 1-sent for email verification')->nullable();
            $table->tinyInteger('email_verified')->default(0)->nullable();
            $table->string('email_verified_ip',225)->nullable();
            $table->timestamp('email_verified_date_time')->nullable();
            $table->string('password',255)->nullable(false);
            $table->string('unique_code',45)->nullable(false);
            $table->string('account_created_ip',225)->nullable();
            $table->string('image',255)->nullable(); 
            $table->tinyInteger('status')->default(0)->comment('0-inactive , 1-active')->nullable(false);
            $table->tinyInteger('account_verified')->comment('0-not verified by ok4homes , 1-verified by ok4homes')->nullable();
            $table->string('is_admin',225)->default(0)->comment('0-not admin , 1-admin')->nullable(false);
            $table->integer('admin_id')->nullable();
            $table->rememberToken()->nullable();
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
        Schema::dropIfExists('users');
    }
}
