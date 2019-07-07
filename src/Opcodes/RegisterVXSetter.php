<?php

namespace PHPEmulators\Chip8\Opcodes;

class RegisterVXSetter extends AbstractOpcode
{
    public function execute(int $code): void
    {
        $registerIndex = ($code & 0x0F00) >> 8;
        $registerValue = ($code & 0x00FF);

        switch ($code & 0xF000) {
            case 0x6000:
                $this->cpu->registers[$registerIndex] = $registerValue;
                break;
            case 0x7000:
                $this->cpu->registers[$registerIndex] += $registerValue;
                break;
        }

        $this->cpu->registerPC += 2;
    }
}
