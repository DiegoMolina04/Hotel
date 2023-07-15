<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class gestionHabitaciones extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_datos()
    {
        use App\Http\Controllers\GestionHabitaciones;
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->post('/user', ['name' => 'Sally']);
 
        $response->assertStatus(201);
    }
}
