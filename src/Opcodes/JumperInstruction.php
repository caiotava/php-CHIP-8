<?php

namespace PHPEmulators\Chip8\Opcodes;

class JumperInstruction extends AbstractOpcode
{
    public function execute(int $code): void
    {
        if ($this->isSkippedInstruction($code)) {
            $this->cpu->registerPC += 4;
            return;
        }

        $this->cpu->registerPC += 2;
    }

    private function isSkippedInstruction(int $code)
    {
        $registerIndex = ($code & 0x0F00) >> 8;
        $registerValue = $this->cpu->registers[$registerIndex];

        switch ($code & 0xF000) {
            case 0x3000:
                return $registerValue == ($code & 0x00FF);
            case 0x4000:
                return $registerValue != ($code & 0x00FF);
            case 0x5000:
                $registerIndexY = ($code & 0x00F0);
                $registerValueY = $this->cpu->registers[$registerIndexY];

                return $registerValue == $registerValueY;
            case 0x9000:
                return $this->isRegistersNotEquals($code);
            default:
                $this->throwInvalidOpcode();
        }
    }

    private function isRegistersNotEquals(int $code): bool
    {
        $registerDestinationIndex = ($code & 0x0F00) >> 8;
        $registerSourceIndex = ($code & 0x00F0) >> 4;

        return $this->cpu->registers[$registerDestinationIndex] != $this->cpu->registers[$registerSourceIndex];
    }
}
