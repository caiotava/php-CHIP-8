<?php

namespace PHPEmulators\Chip8\Opcodes;

class JumperMemory extends AbstractOpcode
{
    const FIRST_REGISTER = 0;

    public function execute(int $code): void
    {
        $this->cpu->registerPC = ($code & 0x0FFF) + $this->cpu->registers[$this::FIRST_REGISTER];
    }
}
