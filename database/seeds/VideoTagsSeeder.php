<?php

use Illuminate\Database\Seeder;

class VideoTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Koya\VideoTag::class, 8)->create();
    }
}
