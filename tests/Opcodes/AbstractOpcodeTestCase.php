<?php

namespace PHPEmulators\Chip8\Opcodes;

use PHPUnit\Framework\TestCase;
use PHPEmulators\Chip8\{Chip8, CPU};
use PHPEmulators\Chip8\Rom\RomStringBuffer;

abstract class AbstractOpcodeTestCase extends TestCase
{
    protected function createOpcode(string $className)
    {
        $chipset = $this->createChipset();
        $cpu = new CPU($chipset);

        return new $className($chipset, $cpu);
    }

    protected function createChipset()
    {
        $rom = new RomStringBuffer('rom foo bar');

        return new Chip8($rom);
    }
}
