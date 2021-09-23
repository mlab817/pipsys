<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Assert;
use Tests\TestCase;

class AuthTest extends TestCase
{
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
}
