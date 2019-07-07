<?php

namespace PHPEmulators\Chip8;

use PHPEmulators\Chip8\Opcodes as Opcodes;

class CPU
{
    public $currentOpcode;
    public $registers;
    public $registerI;
    public $registerPC;
    public $stack;
    public $stackPointer;
    private $chipset;
    private $opcodes;

    public function __construct(Chip8 $chipset)
    {
        $this->chipset = $chipset;
        $this->currentOpcode = 0x0000;
        $this->registers = array_fill(0, 15, 0);
        $this->registerI = 0;
        $this->registerPC = 0;
        $this->stack = array_fill(0, 16, 0);
        $this->stackPointer = null;

        $this->defineOpcodes();
    }

    private function defineOpcodes()
    {
        $this->opcodes[0x0000] = OpCodes\Caller::class;
        $this->opcodes[0x1000] = OpCodes\Jumper::class;
        $this->opcodes[0x2000] = Opcodes\SubroutineCaller::class;
        $this->opcodes[0x3000] = Opcodes\JumperInstruction::class;
        $this->opcodes[0x4000] = Opcodes\JumperInstruction::class;
        $this->opcodes[0x5000] = Opcodes\JumperInstruction::class;
        $this->opcodes[0x6000] = Opcodes\RegisterVXSetter::class;
        $this->opcodes[0x7000] = Opcodes\RegisterVXSetter::class;
        $this->opcodes[0x8000] = Opcodes\RegisterSetter::class;
        $this->opcodes[0x9000] = Opcodes\JumperInstruction::class;
        $this->opcodes[0xA000] = Opcodes\RegisterISetter::class;
        $this->opcodes[0xB000] = Opcodes\JumperMemory::class;
        $this->opcodes[0xC000] = Opcodes\RandomNumberVX::class;
        $this->opcodes[0xD000] = Opcodes\SpriteDrawInstruction::class;
        $this->opcodes[0xE000] = Opcodes\JumperKeyInstruction::class;
        $this->opcodes[0xF000] = Opcodes\DelayTimer::class;
    }

    public function executeCycle()
    {
        $memory[$registerPC] = 0xA2;
        $memory[$registerPC + 1] = 0xF0;
        $currentOpcode = $memory[$registerPC] << 8 | $memory[$registerPC + 1];

        switch ($currentOpcode & 0xF000) {
            case 0xA00:
                $registerI = $opcode & 0x0FFF;
                $registerPC += 2;
                break;
            default:
                echo "Unknown opcode: 0x". $currentOpcode.PHP_EOL;
        }

        if ($delayTime > 0) {
            $delayTime--;
        }

        if ($soundTime > 0) {
            echo "BEEP".PHP_EOL;
            $soundTime--;
        }
    }
}
