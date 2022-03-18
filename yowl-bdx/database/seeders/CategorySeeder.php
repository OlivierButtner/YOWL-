<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            [
                'name' => 'Politique',
//                'created_at' => '2021-12-01 20:01:00',
            ],
            [
                'name' => 'Eco/Conso',
//                'created_at' => '2021-11-11 10:00:00',
            ],
            [
                'name' => 'Sport',
//                'created_at' => '2021-11-11 10:00:00',
            ],
        ]);
    }
}
