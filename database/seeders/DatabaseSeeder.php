<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products=
            [
                [
                    'title'=>'free',
                    'prices'=>0
                ],
                [
                    'title'=>'pro',
                    'prices'=>200
                ],
                [
                    'title'=>'business',
                    'prices'=>3000
                ],
            ];

        foreach ($products as $product)
        {
            Product::create($product);

        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
