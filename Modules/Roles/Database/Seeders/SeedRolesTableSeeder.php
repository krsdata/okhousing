<?php

namespace Modules\Roles\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

          if(DB::table('roles')->get()->count() == 0){
               $tasks =  [
                            [
							'id'  => '1',
                            'name' => 'Developer',
                            'slug' => 'developer',
                            'type'=>'0',
                            ]
                         ];
             DB::table('roles')->insert($tasks);
         }
    }
}
