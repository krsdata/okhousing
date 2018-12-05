<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdministratorDatabaseSeeder extends Seeder
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
        if( $this->call(SeedAdminUsersTableSeeder::class))
        $this->command->info('Table Admin Users seeded!');
    }
}
