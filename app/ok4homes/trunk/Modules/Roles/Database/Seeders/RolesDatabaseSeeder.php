<?php

namespace Modules\Roles\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /* 1 */
        if( $this->call(SeedRolesTableSeeder::class))
        $this->command->info('Table Roles Table seeded!');
        /* 2 */
        if( $this->call(SeedDevPermissionRoleTableSeeder::class))
        $this->command->info('Table Permission Role Table seeded!');
    }
}
