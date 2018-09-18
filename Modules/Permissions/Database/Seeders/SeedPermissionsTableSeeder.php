<?php

namespace Modules\Permissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SeedPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

          if(DB::table('permissions')->get()->count() == 0){
              $tasks =  [
                  
                           [
								'id'   => '1',
                                'name' => 'Create Countries',
                                'slug' => 'create-countries',
                                'module_id'=>'1',
                            ],
                            [	
								'id'   => '2',
                                'name' => 'Edit Countries',
                                'slug' => 'edit-countries',
                                'module_id'=>'1',
                            ],
                            [
								'id'   => '3',
                                'name' => 'View Countries',
                                'slug' => 'view-countries',
                                'module_id'=>'1',
                            ],
                            [
								'id'   => '4',
                                'name' => 'Delete Countries',
                                'slug' => 'delete-countries',
                                'module_id'=>'1',
                            ],
        /* Countries End*/
                            [
								'id'   => '5',
                                'name' => 'Create Module',
                                'slug' => 'create-module',
                                'module_id'=>'2',
                            ],
                            [
								'id'   => '6',
                                'name' => 'Edit Module',
                                'slug' => 'edit-module',
                                'module_id'=>'2',
                            ],
                            [
								'id'   => '7',
                                'name' => 'View Modules',
                                'slug' => 'view-modules',
                                'module_id'=>'2',
                            ],
                            [
								'id'   => '8',
                                'name' => 'Delete Module',
                                'slug' => 'delete-module',
                                'module_id'=>'2',
                            ],
        /* Modules End*/ 
                            [
								'id'   => '9',
                                'name' => 'Create Permissions',
                                'slug' => 'create-permissions',
                                'module_id'=>'3',
                            ],
                            [
								'id'   => '10',
                                'name' => 'Edit Permissions',
                                'slug' => 'edit-permissions',
                                'module_id'=>'3',
                            ],
                            [
								'id'   => '11',
                                'name' => 'View Permissions',
                                'slug' => 'view-permissions',
                                'module_id'=>'3',
                            ],
                            [	
								'id'   => '12',
                                'name' => 'Delete Permissions',
                                'slug' => 'delete-permissions',
                                'module_id'=>'3',
                            ],
        /* Permissions End*/
                            [
								'id'   => '13',
                                'name' => 'Create Roles',
                                'slug' => 'create-roles',
                                'module_id'=>'4',
                            ],
                            [
								'id'   => '14',
                                'name' => 'Edit Roles',
                                'slug' => 'edit-roles',
                                'module_id'=>'4',
                            ],
                            [
								'id'   => '15',
                                'name' => 'View Roles',
                                'slug' => 'view-roles',
                                'module_id'=>'4',
                            ],
                            [	
								'id'   => '16',
                                'name' => 'Delete Roles',
                                'slug' => 'delete-roles',
                                'module_id'=>'4',
                            ],
        /* Roles End*/
                            [
								'id'   => '17',
                                'name' => 'Create Administrator',
                                'slug' => 'create-administrator',
                                'module_id'=>'5',
                            ],
                            [
								'id'   => '18',
                                'name' => 'Edit Administrator',
                                'slug' => 'edit-administrator',
                                'module_id'=>'5',
                            ],
                            [
								'id'   => '19',
                                'name' => 'View Administrator',
                                'slug' => 'view-administrator',
                                'module_id'=>'5',
                            ],
                            [
								'id'   => '20',
                                'name' => 'Delete Administrator',
                                'slug' => 'delete-administrator',
                                'module_id'=>'5',
                            ],
        /* Administrator End*/
                            
                        ];
            DB::table('permissions')->insert($tasks);
         }
    }
}
