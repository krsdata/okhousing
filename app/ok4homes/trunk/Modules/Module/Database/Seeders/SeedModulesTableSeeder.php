<?php

namespace Modules\Module\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if(DB::table('modules')->get()->count() == 0)
        {
              $tasks =  [
                            [
                                'id'=>1,
                                'module_name' => 'Countries',
                                'slug' => 'countries',
                                'module_type'=>'2',
                                'short_code'=>null
                            ],
                            [
                                'id'=>2,
                                'module_name' => 'Modules',
                                'slug' => 'modules',
                                'module_type'=>'2',
                                'short_code'=>null
                            ],
                            
                            [
                                'id'=>3,
                                'module_name' => 'Permissions',
                                'slug' => 'permissions',
                                'module_type'=>'2',
                                'short_code'=>null
                            ],
                            [
                                'id'=>4,
                                'module_name' => 'Roles',
                                'slug' => 'roles',
                                'module_type'=>'2',
                                'short_code'=>null
                            ],
                            [
                                'id'=>5,
                                'module_name' => 'Administrator',
                                'slug' => 'administrator',
                                'module_type'=>'2',
                                'short_code'=>null
                            ],
                            [
                                'id'=>6,
                                'module_name' => 'Advertiser',
                                'slug' => 'advertiser',
                                'module_type'=>'0',
                                'short_code'=>'ADR'
                            ],
                            [
                                'id'=>7,
                                'module_name' => 'Agent',
                                'slug' => 'agent',
                                'module_type'=>'0',
                                'short_code'=>'AGT'
                            ],
                            [
                                'id'=>8,
                                'module_name' => 'Builders',
                                'slug' => 'builders',
                                'module_type'=>'1',
                                'short_code'=>'BLS'
                            ],
                            [
                                'id'=>9,
                                'module_name' => 'Home Interiors',
                                'slug' => 'home-interiors',
                                'module_type'=>'1',
                                'short_code'=>'HIS'
                            ],
                            [
                                'id'=>10,
                                'module_name' => 'Home Stay',
                                'slug' => 'home-stay',
                                'module_type'=>'1',
                                'short_code'=>'HSY'
                            ],
                            [
                                'id'=>11,
                                'module_name' => 'Buyer',
                                'slug' => 'buyer',
                                'module_type'=>'0',
                                'short_code'=>'BYR'
                            ],
                            [
                                'id'=>12,
                                'module_name' => 'Utility',
                                'slug' => 'utility',
                                'module_type'=>'0',
                                'short_code'=>'UTY'
                            ],
                        ];
             
             
             DB::table('modules')->insert($tasks);
         }
    }
}
