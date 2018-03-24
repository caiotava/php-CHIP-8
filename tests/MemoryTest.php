<?php

namespace PHPEmulators\Chip8;

use PHPUnit\Framework\TestCase;

class MemoryTest extends TestCase
{
    public function testCount()
    {
        $memory = new Memory(10);

        $this->AssertCount(10, $memory);
    }

    public function testGetIterator()
    {
        $memory = new Memory(10);

        $this->assertInstanceOf(\Traversable::class, $memory->getIterator());
    }

    public function testTraversable()
    {
        $memory = new Memory(3, 'foo');

        foreach ($memory as $block) {
            $this->assertEquals('foo', $block);
        }
    }

    public function testOffsetExists()
    {
        $memory = new Memory(10, 0);

        $this->assertTrue(isset($memory[9]));
    }

    public function testOffsetNotExists()
    {
        $memory = new Memory(9, 0);

        $this->assertFalse(isset($memory[9]));
    }

    public function testOffsetGet()
    {
        $memory = new Memory(10, 'foo');

        $this->assertEquals('foo', $memory[9]);
    }

    public function testOffsetGetInvalidIndex()
    {
        $memory = new Memory(10, 'foo');

        $this->assertNull($memory[20]);
    }

    public function testOffsetSet()
    {
        $memory = new Memory(10, 'foo');

        $memory[9] = 'bar';

        $this->assertEquals('bar', $memory[9]);
    }

    public function testOffsetSetNullOffset()
    {
        $this->expectException(\BadMethodCallException::class);

        $memory = new Memory(10, 0);

        $memory[] = 'foo';
    }

    public function testOffsetSetInvalidRange()
    {
        $this->expectException(\OutOfRangeException::class);

        $memory = new Memory(10, 0);

        $memory[20] = 'baz';
    }
}
