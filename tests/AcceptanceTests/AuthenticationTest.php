<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTraditionalRegistration()
    {
        $user = factory(Koya\User::class)->make();
        $this->visit('/register')
            ->type($user->name, 'name')
            ->type($user->email, 'email')
            ->type($user->username, 'username')
            ->type('test-password', 'password')
            ->type('test-password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/dashboard');
    }

    public function testTraditionalLogin()
    {
        $user = factory(Koya\User::class)->create([
            'password' => bcrypt('testPass'),
        ]);
        $this->visit('/')
            ->type($user->email, 'email')
            ->type('testPass', 'password')
            ->press('Login')
            ->seePageIs('/dashboard');
    }

    public function testFacebookLogin()
    {
        //TODO add social authentication test
    }
}
