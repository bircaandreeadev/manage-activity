<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@managetasksfake.ro',
            'password' => Hash::make('password'),            
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Popescu Ion',
            'email' => 'ipopescu@managetasksfake.ro',
            'password' => Hash::make('password'),            
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('user');

        $user = User::create([
            'name' => 'Radu Cristian',
            'email' => 'cradu@managetasksfake.ro',
            'password' => Hash::make('password'),            
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('user');

        $user = User::create([
            'name' => 'Ionescu Cristina',
            'email' => 'cionescu@managetasksfake.ro',
            'password' => Hash::make('password'),            
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('user');

        $user = User::create([
            'name' => 'Diana',
            'email' => 'diana@managetasksfake.ro',
            'password' => Hash::make('password'),            
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('user');

        $user = User::create([
            'name' => 'Gireada Iulian',
            'email' => 'igireada@managetasksfake.ro',
            'password' => Hash::make('password'),            
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('user');

        $user = User::create([
            'name' => 'Mihai Radu',
            'email' => 'rmihai@managetasksfake.ro',
            'password' => Hash::make('password'),            
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('user');


    }
}
