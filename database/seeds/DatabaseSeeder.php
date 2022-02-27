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
        // $this->call(UserSeeder::class);
        $this->call(AuthorSeederTable::class);
        $this->call(BookSeederTable::class);
        $this->call(CategorySeederTable::class);
        $this->call(MediaSeederTable::class);
        $this->call(TeamSeederTable::class);
    }
}
