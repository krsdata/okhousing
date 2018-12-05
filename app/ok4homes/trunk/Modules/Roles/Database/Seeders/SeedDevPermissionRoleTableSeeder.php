<?php

namespace Modules\Roles\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SeedDevPermissionRoleTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
Model::unguard();

if(DB::table('role_permissions')->get()->count() == 0)
{
$tasks =  [
                    [
                            'role_id'		=> '1',
                            'permission_id' => '1',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '2',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '3',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '4',
                    ],
/* Countries End*/
                    [
                            'role_id'		=> '1',
                            'permission_id' => '5',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '6',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '7',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '8',
                    ],
/* Modules End*/

                    [
                            'role_id'		=> '1',
                            'permission_id' => '9',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '10',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '11',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '12',
                    ],
/* Permissions End*/
                    [
                            'role_id'		=> '1',
                            'permission_id' => '13',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '14',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '15',
                    ],

                    [
                            'role_id'		=> '1',
                            'permission_id' => '16',
                    ],
/* Roles End*/
                    [
                            'role_id'		=> '1',
                            'permission_id' => '17',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '18',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '19',
                    ],
                    [
                            'role_id'		=> '1',
                            'permission_id' => '20',
                    ],

/* Administrator End*/
            ];
DB::table('role_permissions')->insert($tasks);
}

}
}
