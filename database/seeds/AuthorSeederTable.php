<?php

use Illuminate\Database\Seeder;

class AuthorSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Author::class,50)->create();
    }
}
