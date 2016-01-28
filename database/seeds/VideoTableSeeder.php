<?php

use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $videoTag = \Koya\VideoTag::all();
        $video = factory(Koya\Video::class, 50)
            ->create()
            ->each(function($v) use($videoTag){
                $v->tags()->save($videoTag[rand(0, count($videoTag) - 1)]);
            }) ;
    }
}
