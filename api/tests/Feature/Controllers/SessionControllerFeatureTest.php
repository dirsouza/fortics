<?php

namespace Tests\Feature\Controllers;

use App\Models\Message;
use App\Models\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @testdox deve retornar a lista de sessões
     */
    public function testShouldReturnTheListOfSessions()
    {
        factory(Session::class, 10)
            ->create()
            ->each(fn($session) => $session
                ->messages()
                ->save(factory(Message::class)->create()));

        $response = $this->getJson(route('session.list'));

        $response->assertStatus(200);

        $result = $response->getOriginalContent();

        $this->assertTrue($result['success']);
        $this->assertEquals('Conversas encontradas!', $result['message']);
        $this->assertIsArray($result['data']);
        $this->assertCount(10, $result['data']);
        $this->assertCount(1, $result['data'][0]['messages']);
    }

    /**
     * @testdox deve retornar a lista de sessões com base no nome
     */
    public function testShouldReturnTheListOfSessionsBasedOnTheName()
    {
        factory(Session::class, 10)
            ->create()
            ->each(fn($session) => $session
                ->messages()
                ->save(factory(Message::class)->create()));

        $name = Session::all()->random()->name;

        $response = $this->getJson(route('session.list', ['name' => $name]));

        $response->assertStatus(200);

        $result = $response->getOriginalContent();

        $this->assertTrue($result['success']);
        $this->assertEquals('Conversas encontradas!', $result['message']);
        $this->assertIsArray($result['data']);
        $this->assertCount(1, $result['data']);
        $this->assertCount(1, $result['data'][0]['messages']);
        $this->assertEquals($name, $result['data'][0]['name']);
    }

    /**
     * @testdox deve retornar a lista de sessões vazia
     */
    public function testShouldReturnTheEmptySessionList()
    {
        $response = $this->getJson(route('session.list'));

        $response->assertStatus(404);

        $result = $response->getOriginalContent();

        $this->assertFalse($result['success']);
        $this->assertEquals('Nenhuma conversa encontrada!', $result['message']);
        $this->assertNull($result['data']);
    }
}
