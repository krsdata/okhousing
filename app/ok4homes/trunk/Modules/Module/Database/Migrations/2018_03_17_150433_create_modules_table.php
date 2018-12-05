<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
            Schema::create('modules', function (Blueprint $table) { 
            $table->increments('id');
            $table->string('module_name',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->tinyInteger('parent')->default(0)->nullable(false);
            $table->string('icon',255)->nullable();
            $table->string('slug',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->tinyInteger('module_type')->comment('0-main (free) , 1-other (paid), 2-admin')->nullable(false);
            $table->string('short_code',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0-inactive , 1-active')->nullable(false);
            $table->tinyInteger('re_order')->nullable();
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
        Schema::dropIfExists('modules');
    }
}
