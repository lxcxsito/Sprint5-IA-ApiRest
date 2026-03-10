<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        if (app()->environment('testing')) {
            $this->call(\Database\Seeders\PassportSeeder::class);
        }

        // \App\Models\User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        $this->call(class: [CategorySeeder::class, GameSeeder::class, UserSeeder::class, ReviewSeeder::class, PurchaseSeeder::class]);
    }
}
    
