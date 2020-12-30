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
        $this->call(PermissionsTableSeeder::class);
        $this->call(FakultasesTableSeeder::class);
        $this->call(ProdisTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(KategorisTableSeeder::class);
        $this->call(KegiatansTableSeeder::class);
    }
}
