<?php

namespace PHPEmulators\Chip8\Opcodes;

class RegisterISetter extends AbstractOpcode
{
    public function execute(int $code): void
    {
        $this->cpu->registerI = $code & 0x0FFF;
        $this->cpu->registerPC += 2;
    }
}
