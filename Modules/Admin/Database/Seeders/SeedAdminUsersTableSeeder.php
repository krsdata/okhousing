<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedAdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if(DB::table('admin_users')->get()->count() == 0){
             $tasks =  [
                            [
                                'name' => 'Ok4Homes',
                                'email' => 'ok4@ok4.com',
                                'status'=>'1',
                                'is_developer'=>'1', 
                                'password' => bcrypt('password'),
                            ]
                        ];
             
             DB::table('admin_users')->insert($tasks);
         }
    }
}
