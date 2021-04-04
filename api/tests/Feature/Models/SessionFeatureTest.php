<?php

namespace Tests\Feature\Models;

use App\Models\Message;
use App\Models\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class SessionFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @testdox deve existir o relacionamento com mensagem
     */
    public function testShouldRelationshipWithMessageMustExist()
    {
        factory(Session::class)
            ->create()
            ->each(fn($session) => $session->messages()->save(factory(Message::class)->make()));

        /**
         * @var Session $session
         */
        $session = Session::first();

        $this->assertDatabaseHas('sessions', $session->toArray());
        $this->assertDatabaseHas('messages', $session->messages->first()->toArray());
        $this->assertEquals(1, $session->count());
        $this->assertEquals(1, $session->first()->messages->count());
    }

    /**
     * @testdox deve retornar todas as conversas sem filtro
     */
    public function testShouldReturnAllSessionsUnfiltered()
    {
        factory(Session::class, 5)->create();

        /**
         * @var Session $session
         */
        $sessions = Session::allSessions()->get();

        $this->assertEquals(5, $sessions->count());
    }

    /**
     * @testdox deve retornar a conversa filtrada pelo identificador do usuário
     */
    public function testShouldReturnTheSessionFilteredByUserIdentifier()
    {
        factory(Session::class, 5)->create();

        /**
         * @var Session $session
         */
        $session = Session::all()->random();

        /**
         * @var Session $filtered
         */
        $filtered = Session::findByIdentifier($session->contact_identifier)->first();

        $this->assertEquals($session->toArray(), $filtered->toArray());
    }
}
