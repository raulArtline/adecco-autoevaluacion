<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(QuestionSeeder::class);
        $this->call(SurveySeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // crear usuario a mano
        User::create([
            'name' => "Admin",
            'email' => "raul@artline.es",
            'is_admin' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('Artline@82'),
            'remember_token' => Str::random(10),
        ]);
    }
}
