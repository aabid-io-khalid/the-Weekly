<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Annonce;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  User::factory(10)->create();

        //  Category::factory(5)->create();


        // Annonce::factory(20)->create();
        
        
         Comment::factory(10)->create();
    }
}
