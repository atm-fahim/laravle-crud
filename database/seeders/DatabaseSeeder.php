<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         for ($i=0; $i <= 100; $i++) {
        DB::table('student_info')->insert([
            'name' => Str::random(10),
            'gender' => Str::random(6),
            'class' => Str::random(6),
            'email' => Str::random(10) . '@gmail.com',
            'status'=>random_int(0,1)
        ]);
    }
    }
}
