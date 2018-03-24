<?php

namespace PHPEmulators\Chip8\Rom;

class RomStringBuffer implements Rom
{
    private $rom;
    private $size;

    public function __construct(string $buffer)
    {
        $this->rom = $buffer;
        $this->size = strlen($this->rom);
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function read(int $index): string
    {
        return $this->rom[$index];
    }

    public function readHex(int $index): int
    {
        return ord($this->read($index));
    }

    public function toArrayHex(): array
    {
        $bufferHex = [];

        for ($i = 0; $i < $this->getSize(); $i++) {
            $bufferHex[] = $this->readHex($i);
        }

        return $bufferHex;
    }
}
