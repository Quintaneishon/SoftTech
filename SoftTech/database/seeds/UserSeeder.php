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
            'name' => 'Joel',
            'email' => 'Joel@gmail.com',
            'password' => bcrypt(123456),
            'especialidad_id' => $especialidadId,
        ]);

        User::create([
            'name' => 'Joel',
            'email' => 'Joel2@gmail.com',
            'password' => bcrypt(123456),
            'especialidad_id' => null,
        ]);
    }
}
