<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('slug',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->text('description')->collation('utf8mb4_unicode_ci')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->tinyInteger('status')->default(1)->comment('0-inactive , 1-active')->nullable(false);
            $table->tinyInteger('type')->default(1)->comment('0-developer,1-admin, 2-user');
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
        Schema::dropIfExists('roles');
    }
}
