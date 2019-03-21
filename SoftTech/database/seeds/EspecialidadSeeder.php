<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        /* DB::insert('INSERT INTO especialidad (title) VALUES (:title)',[
            'title' => 'Desarrollador Web'
        ]); */

        DB::table('especialidad')->insert([
            'title' => 'Desarrollador Web'
        ]);
    }
}
