<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (! User::where('username','ftp')->exists()) {
            $user = User::create([
                'name'      => 'FTP',
                'email'     => 'ftp@gmail.com',
                'username'  => 'ftp',
                'password'  => Hash::make('password')
            ]);
            $user->activated_at = now();
            $user->save();
        }

         \App\Models\User::factory(10)->create();
    }
}
