<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('permissions', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name',255)->collation('utf8mb4_unicode_ci')->nullable(false);
        $table->string('slug',255)->collation('utf8mb4_unicode_ci')->nullable(false);
        $table->integer('module_id')->unsigned();
        $table->foreign('module_id')->references('id')->on('modules');
        $table->text('description')->collation('utf8mb4_unicode_ci')->nullable();
        $table->tinyInteger('status')->default(1)->comment('0-inactive , 1-active')->nullable(false);
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
        Schema::dropIfExists('permissions');
    }
}
