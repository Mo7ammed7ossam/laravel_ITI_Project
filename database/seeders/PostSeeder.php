<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $index) :

            DB::table('posts')->insert([
                'title' => Str::random(15),
                'description' => Str::random(100),
                'user_id' => random_int(1, 2),
                'created_at' => now()
            ]);

        endforeach;
    }
}
