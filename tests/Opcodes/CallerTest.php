<?php

namespace PHPEmulators\Chip8\Opcodes;

use PHPEmulators\Chip8\Rom\RomStringBuffer;

class CallerTest extends AbstractOpcodeTestCase
{
    public function testClearScreen()
    {
        $callerOpcode = $this->createOpcode(Caller::class);

        $callerOpcode->chipset->graphicMemory[0] = 1;

        $callerOpcode->execute(0x00E00000);

        $this->assertTrue($callerOpcode->chipset->drawFlag);
        $this->assertEquals(0, $callerOpcode->chipset->graphicMemory[0]);
    }

    public function testReturnSubroutine()
    {
        $callerOpcode = $this->createOpcode(Caller::class);

        $callerOpcode->cpu->stack = [1, 2];
        $callerOpcode->cpu->stackPointer = 1;
        $callerOpcode->cpu->registerPC = 0;

        $callerOpcode->execute(0x00EE000E);

        $this->assertEquals(0, $callerOpcode->cpu->stackPointer);
        $this->assertEquals(3, $callerOpcode->cpu->registerPC);
    }

    public function testInvalidOpcode()
    {
        $this->expectException(\InvalidArgumentException::class);

        $callerOpcode = $this->createOpcode(Caller::class);

        $callerOpcode->execute(0xFFFFFFFF);
    }
}
