<?php

namespace Modules\Permissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsDatabaseSeeder extends Seeder
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
        if( $this->call(SeedPermissionsTableSeeder::class))
        $this->command->info('Table Permissions Table seeded!');
    }
}
