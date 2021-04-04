<?php

namespace Tests\Unit\Models;

use App\Models\Message;
use PHPUnit\Framework\TestCase;

class MessageUnitTest extends TestCase
{
    private Message $message;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->message = new Message();
    }

    /**
     * @testdox deve verificar se o nome da tabela está correto
     */
    public function testTable()
    {
        $this->assertEquals('messages', $this->message->getTable());
    }

    /**
     * @testdox deve verificar se o array de 'guarded' está com os atributos corretos
     */
    public function testGuarded()
    {
        $this->assertEquals(['id', 'date'], $this->message->getGuarded());
    }

    /**
     * @testdox deve verificar se o 'timestamp' está falso
     */
    public function testTimestambs()
    {
        $this->assertFalse($this->message->timestamps);
    }
}
