<?php

namespace Tests\Unit\Models;

use App\Models\Session;
use PHPUnit\Framework\TestCase;

class SessionUnitTest extends TestCase
{
    private Session $session;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->session = new Session();
    }

    /**
     * @testdox deve verificar se o nome da tabela está correto
     */
    public function testTable()
    {
        $this->assertEquals('sessions', $this->session->getTable());
    }

    /**
     * @testdox deve verificar se o array de 'guarded' está com os atributos corretos
     */
    public function testGuarded()
    {
        $this->assertEquals(['id'], $this->session->getGuarded());
    }

    /**
     * @testdox deve verificar se o 'timestamp' está falso
     */
    public function testTimestambs()
    {
        $this->assertFalse($this->session->timestamps);
    }
}
