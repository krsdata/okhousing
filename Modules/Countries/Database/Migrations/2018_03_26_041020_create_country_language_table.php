<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_language', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('font_path',255)->collation('utf8_unicode_ci')->nullable(false);
            $table->integer('created_country_id')->unsigned();
            $table->foreign('created_country_id')->references('id')->on('countries');
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('all_languages');
            $table->tinyInteger('isDefault')->default(0)->comment('1-Default_language');
            $table->tinyInteger('is_active')->default(0)->comment('1-active');
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
        Schema::dropIfExists('country_language');
    }
}
