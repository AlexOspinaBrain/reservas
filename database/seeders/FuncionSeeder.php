<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funciones')->insert([
            'titulo' => 'The lord of the rings',
            'inicio' =>  date('Y-m-d H:i:s', time()),
        ]);
        DB::table('funciones')->insert([
            'titulo' => 'SAW',
            'inicio' =>  date('Y-m-d H:i:s', time()),
        ]);
        DB::table('funciones')->insert([
            'titulo' => 'Back to the future',
            'inicio' =>  date('Y-m-d H:i:s', time()),
        ]);
    }
}
