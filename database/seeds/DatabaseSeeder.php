<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            PageSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            CategoryPostSeeder::class,
            PostTagSeeder::class,
        ]);
    }
}
