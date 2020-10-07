<?php

namespace PHPEmulators\Chip8\Opcodes;

class Jumper extends AbstractOpcode
{
    public function execute(int $code): void
    {
        $this->cpu->registerPC = $code & 0x0FFF;
    }
}
