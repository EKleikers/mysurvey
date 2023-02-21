<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SMEsSeeder::class
            //SurveyssSeeder::class,
            //ResultssSeeder::class,
            //ReportsSeeder::class,
        ]);
    }
}
