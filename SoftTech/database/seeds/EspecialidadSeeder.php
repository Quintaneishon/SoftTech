<?php

use App\Especialidad;
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
        // DB::insert('INSERT INTO especialidad (title) VALUES (:title)',[
        //     'title' => 'Desarrollador Web'
        // ]);

        //  DB::table('especialidad')->insert([
        //     'title' => 'Desarrollador Web'
        // ]);

        Especialidad::create([
            'title' => 'Desarrollador Web',
        ]);

        Especialidad::create([
            'title' => 'Desarrollador Java',
        ]);

        Especialidad::create([
            'title' => 'Desarrollador Python',
        ]);

        factory(Especialidad::class,5)->create();
    }
}
