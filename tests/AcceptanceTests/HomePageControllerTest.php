<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Koya\Repositories\VideoRepository;
use Koya\Libraries\Cloudinary;
class HomePageControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexMethod()
    {
        $this->call('GET', '/');
        $this->assertViewHas('videos');
    }

}
