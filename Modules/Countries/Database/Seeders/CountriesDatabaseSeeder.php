<?php

namespace Modules\Countries\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CountriesDatabaseSeeder extends Seeder
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
        if( $this->call(SeedAllCountriesTableSeeder::class))
        $this->command->info('Table All Countries seeded!');
        
        /* 2 */
        if( $this->call(SeedAllLanguagesTableSeeder::class))
        $this->command->info('Table All Languages seeded!');
        
        
        
    }
}
