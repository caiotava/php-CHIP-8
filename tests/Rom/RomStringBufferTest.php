<?php

namespace PHPEmulators\Chip8\Rom;

use PHPUnit\Framework\TestCase;

class RomStringBufferTest extends TestCase
{
    public function testGetSize()
    {
        $rom = new RomStringBuffer('foo');

        $this->assertEquals(3, $rom->getSize());
    }

    public function testRead()
    {
        $rom = new RomStringBuffer('bar');

        $this->assertEquals('r', $rom->read(2));
    }

    public function testReadInvalidIndex()
    {
        $rom = new RomStringBuffer('foo');

        $this->assertEquals('', $rom->read(10));
    }

    public function testReadHex()
    {
        $rom = new RomStringBuffer('foo');

        $this->assertEquals(ord('f'), $rom->readHex(0));
    }

    public function testToArrayHex()
    {
        $rom = new RomStringBuffer('foo');

        $expectedArrayHex = [
            ord('f'),
            ord('o'),
            ord('o'),
        ];

        $this->assertEquals($expectedArrayHex, $rom->toArrayHex());
    }
}
