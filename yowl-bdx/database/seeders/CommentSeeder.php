<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'content' => Str::random(3).' - comment from seeder',
            'article_id' => 7,
            'user_id' => 3,
            'created_at' => '2021-11-11 08:00:00',
        ]);
    }
}
