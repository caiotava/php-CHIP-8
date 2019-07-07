<?php

namespace PHPEmulators\Chip8\Opcodes;

use PHPEmulators\Chip8\{Chip8, CPU};

abstract class AbstractOpcode implements Opcode
{
    public $chipset;
    public $cpu;

    public function __construct(Chip8 $chipset, CPU $cpu)
    {
        $this->chipset = $chipset;
        $this->cpu = $cpu;
    }

    protected function throwInvalidOpcode(): void
    {
        throw new \InvalidArgumentException('Invalid Opcode');
    }
}
