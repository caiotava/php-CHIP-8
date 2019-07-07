<?php

namespace PHPEmulators\Chip8\Opcodes;

use PHPEmulators\Chip8\{Chip8, CPU};

interface Opcode
{
    public function __construct(Chip8 $chipset, CPU $cpu);
    public function execute(int $code): void;
}
