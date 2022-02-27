<?php

use Illuminate\Database\Seeder;

class MediaSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Media::class,50)->create();
    }
}
