<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserAddVideo()
    {
        factory(Koya\Category::class)->create();

        $user = factory(Koya\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'test']);

        $video = factory(Koya\Video::class)->make();

        $this->visit('/dashboard')
            ->type('https://www.youtube.com/embed/'.$video->youtubeID, 'youtubeID')
            ->type($video->title, 'title')
            ->select(0, 'category')
            ->type($video->description, 'description')
            ->press('Save')
            ->see('video added')
            ->see($video->title);
    }

    public function testUserPostInvalidYoutubeLink()
    {
        factory(Koya\Category::class)->create();

        $user = factory(Koya\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'test']);

        $video = factory(Koya\Video::class)->make();

        $this->visit('/dashboard')
            ->type('https://www.youtube.com/embed/invalidlink', 'youtubeID')
            ->type($video->title, 'title')
            ->select(0, 'category')
            ->type($video->description, 'description')
            ->press('Save')
            ->see('This video does not exist');
    }

    public function testUserEditsProfile()
    {
        $user = factory(Koya\User::class)->create([
            'password' => bcrypt('testUser'),
        ]);
        $this->actingAs($user)
            ->withSession(['username' => $user->username]);
        $this->visit('/'.$user->username)
            ->click('Edit your profile')
            ->seePageIs('/'.$user->username.'/edit')
            ->see('Edit your profile');
    }

    public function testAnotherUserVisitUserProfile()
    {
        $user = factory(Koya\User::class)->create([
            'password' => bcrypt('testUser'),
        ]);

        $this->visit('/'.$user->username)
            ->dontSeeLink('Edit your profile');
    }

    public function testAnotherUserAccessUserProfileEdit()
    {
        $user = factory(Koya\User::class)->create();

//        dd(Koya\User::find(1)->toArray());
        $this->call('GET', "$user->username/edit")
        ->isForbidden();
    }
}
