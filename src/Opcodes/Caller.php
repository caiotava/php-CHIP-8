<?php

namespace PHPEmulators\Chip8\Opcodes;

class Caller extends AbstractOpcode
{
    public function execute(int $code): void
    {
        switch ($code & 0x000F) {
            case 0x0000:
                $this->clearScreen();
                break;
            case 0x000E:
                $this->returnSubroutine();
                break;
            default:
                $this->throwInvalidOpCode();
        }
    }

    private function clearScreen()
    {
        $graphicMemory = $this->chipset->graphicMemory;

        for ($i = 0; $i < count($graphicMemory); $i++) {
            $graphicMemory[$i] = 0;
        }

        $this->chipset->drawFlag = true;
        $this->cpu->registerPC++;
    }

    private function returnSubroutine()
    {
        $this->cpu->stackPointer--;
        $this->cpu->registerPC = $this->cpu->stack[$this->cpu->stackPointer];

        $this->cpu->registerPC += 2;
    }
}
