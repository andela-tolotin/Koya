<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LandingPageTest extends TestCase
{
    public function __call($method, $args)
    {
        if(in_array($method, ['get', 'post', 'patch', 'put', 'delete'])) {
            $this->call($method, $args[0]);
        }

        throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException();

    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testss()
    {
        $this->action('GET');
    }
}
