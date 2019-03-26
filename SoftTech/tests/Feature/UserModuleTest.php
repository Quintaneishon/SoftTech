<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class UserModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function it_create_a_new_user()
    {
        $this->post('/usuarios/crear',[
            'name' => 'Prueba',
            'email' => 'prueba@gmail.com',
            'password' => '123456'
        ])->assertSee('Procesando informacion...');
    }
}
