<?php

namespace PHPEmulators\Chip8\Opcodes;

class SubroutineCaller extends AbstractOpcode
{
    public function execute(int $code): void
    {
        $this->cpu->stack[$this->cpu->stackPointer] = $this->cpu->registerPC;

        $this->cpu->stackPointer++;

        $this->cpu->registerPC = $code & 0x0FFF;
    }
}
