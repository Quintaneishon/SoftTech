<?php

use Illuminate\Database\Seeder;
use App\Especialidad;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidadId = Especialidad::where('title','Desarrollador Web')->value('id');
        User::create([
            'tipo'=> 'desarrollador',
            'name' => 'Joel',
            'email' => 'Joel@gmail.com',
            'password' => bcrypt(123456),
            'especialidad_id' => $especialidadId,
            'foto' => null,
            'descripcion' => 'Soy un desarrollador super responsable y trabajador',
            'calificacion' => 5
        ]);

        User::create([
            'tipo'=> 'cliente',
            'name' => 'Joelo',
            'email' => 'Joelo@gmail.com',
            'password' => bcrypt(123456),
            'especialidad_id' => null,
            'foto' => null,
            'descripcion' => null,
            'calificacion' => 5
        ]);

        // User::create([
        //     'name' => 'Joel',
        //     'email' => 'Joel2@gmail.com',
        //     'password' => bcrypt(123456),
        //     'especialidad_id' => null,
        // ]);
    }
}
