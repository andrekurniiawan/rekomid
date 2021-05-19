<?php

use Illuminate\Database\Seeder;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('category_post')->insert(
                [
                    'post_id' => rand(1, 20),
                    'category_id' => rand(1, 10)
                ]
            );
        }
    }
}
