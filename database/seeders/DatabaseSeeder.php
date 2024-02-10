<?php

namespace Database\Seeders;

use App\Models\Posts;
use App\Models\Subscriptions;
use App\Models\User;
use App\Models\WebSites;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $site = WebSites::create([
            'domain' => 'testDomain',
            'status' => '0',
        ]);
        $user = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('1234567890'),
        ]);
        Subscriptions::create([
            'status' => '0',
            'user_id' => $user->id,
            'email' => 'test@gmail.com',
            'website_id' => $site->id,
        ]);
        Posts::create([
            'title' => 'test title',
            'description' => 'test description',
            'status' => '0',
            'website_id' => $site->id,
        ]);
    }
}
