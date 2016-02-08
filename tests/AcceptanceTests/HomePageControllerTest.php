<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

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
