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
//        $faker = Faker\Factory::create();
//        foreach(range(1, 50) as $index) {
//            $video = factory(Koya\Video::class)->create();
//
//            $video->tags()->save($videoTag);
//        }
//        $users = Koya\User::all();
//
//        factory(Koya\Video::class, 50)->create([
//            'title' => $faker->city,
//            'link' => $faker->domainName,
//            'user_id' => $faker->randomElement($users->toArray()),
//            'description' => $faker->sentence(40)
//        ]);


    }
}
