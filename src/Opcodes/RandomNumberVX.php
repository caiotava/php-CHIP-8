<?php

namespace PHPEmulators\Chip8\Opcodes;

class RandomNumberVX extends AbstractOpcode
{
    const MAX_RAND_NUMBER = 256;

    public function execute(int $code): void
    {
        $registerIndex = ($code & 0x0F00) >> 8;
        $randomValue = (rand() % $this::MAX_RAND_NUMBER);
        $registerValue = $randomValue & ($code & 0x00FF);

        $this->cpu->registers[$registerIndex] = $registerValue;

        $this->cpu->registerPC += 2;
    }
}
