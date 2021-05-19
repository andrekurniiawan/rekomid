<?php

use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('post_tag')->insert(
                [
                    'post_id' => rand(1, 20),
                    'tag_id' => rand(1, 40)
                ]
            );
        }
    }
}
