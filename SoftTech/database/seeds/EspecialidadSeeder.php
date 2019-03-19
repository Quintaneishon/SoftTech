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
        DB::table('especialidad')->insert([
            'title' => 'Desarrollador Web'
        ]);
    }
}
