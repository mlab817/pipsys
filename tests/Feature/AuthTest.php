<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Assert;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_shows_login_page()
    {
        $this->get('/login')
            ->assertSee('Login')
            ->assertSee('Email or username')
            ->assertSee('Password')
            ->assertSee('Forgot Your Password?');
    }

    public function test_it_logins_user_with_username_and_password_and_redirect_to_home()
    {
        $user = User::create([
            'name'      => 'FTP',
            'email'     => 'ftp@gmail.com',
            'username'  => 'ftp',
            'password'  => Hash::make('password')
        ]);
        $user->activated_at = now();
        $user->save();

        $this->post('/login', [
            'username' => 'ftp@gmail.com',
            'password' => 'password'
        ])->assertRedirect('/home');

        $this->assertAuthenticatedAs($user);
    }

    public function test_it_throws_error_when_user_is_not_activated()
    {
        // user is not yet activated
        $user = User::create([
            'name'      => 'FTP',
            'email'     => 'ftp2@gmail.com',
            'username'  => 'ftp2',
            'password'  => Hash::make('password')
        ]);

        $this->actingAs($user);

        $this->get('/home')
            ->assertRedirect('/login')
            ->assertSessionHas('error','User is not activated. Please contact admin');
    }

    public function test_it_allows_user_to_login_via_gmail()
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');

        $abstractUser
            ->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getName')
            ->andReturn(str_random(10))
            ->shouldReceive('getEmail')
            ->andReturn(str_random(10) . '@gmail.com')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        Socialite::shouldReceive('driver->user')->andReturn($abstractUser);

        $this->get('/auth/google/callback')
            ->assertRedirect('/home');
    }
}
