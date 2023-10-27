<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
            'name'=>'John Paul',
            'email'=>'drbugembe@gmail.com'
        ]);
        Listing::factory(5)->create([
            'user_id'=>$user->id
        ]);
        // Listings::create([
        //     'title'=>'Laravel Senior developer',
        //     'tags'=>'javascript, php, laravel',
        //     'company'=>'laratick',
        //     'location'=>'London',
        //     'email'=>'laravel@gmail.com',
        //     'website'=>'laravel.com',
        //     'description'=>'Hello there visit our website atlaravel.com',
        // ]);
        // Listings::create([
        //     'title'=>'PHP Senior developer',
        //     'tags'=>'javascript, php, laravel',
        //     'company'=>'BAKH technologies',
        //     'location'=>'Kampala Uganda',
        //     'email'=>'bakhtechnogies@gmail.com',
        //     'website'=>'bakhtechnologies.com',
        //     'description'=>'Hello there Please visit our website  at bakhtechnologies.com',
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
