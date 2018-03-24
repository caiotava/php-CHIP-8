<?php

namespace PHPEmulators\Chip8;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Traversable;

class Memory implements ArrayAccess, Countable, IteratorAggregate
{
    private $blocks;

    public function __construct(int $numberOfBlocks, $defaultValue = 0)
    {
        $this->blocks = array_fill(0, $numberOfBlocks, $defaultValue);
    }

    public function count()
    {
        return count($this->blocks);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->blocks);
    }

    public function offsetExists($offset)
    {
        return isset($this->blocks[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->blocks[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $exceptionMessage = 'Offset parameter is required';

            throw new \BadMethodCallException($exceptionmessage);
        }

        if ($offset >= count($this->blocks) || $offset < 0) {
            $exceptionMessage = 'Out of memory range';

            throw new \OutOfRangeException($exceptionMessage);
        }

        $this->blocks[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        $exceptionMessage = 'Unset should not be called';

        throw new \LogicException($exceptionMessage);
    }
}
