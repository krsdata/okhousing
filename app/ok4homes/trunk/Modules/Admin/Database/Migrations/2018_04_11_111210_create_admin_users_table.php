<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('email',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('password',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('image',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->tinyInteger('status')->comment('0-inactive , 1-active')->nullable(false);
            $table->tinyInteger('is_developer')->comment('0-developer , 1-other')->nullable(false)->default('1');
            $table->string('remember_token',100)->nullable();
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
        Schema::dropIfExists('admin_users');
    }
}
