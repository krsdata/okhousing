<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->collation('utf8_unicode_ci')->nullable(false);
            $table->string('lang_code',255)->collation('utf8_unicode_ci')->nullable(false);
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
        Schema::dropIfExists('all_languages');
    }
}
