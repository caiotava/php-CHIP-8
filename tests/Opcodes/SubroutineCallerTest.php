<?php

namespace PHPEmulators\Chip8\Opcodes;

class SubroutineCallerTest extends AbstractOpcodeTestCase
{
    public function testExecute()
    {
        $opcode = $this->createOpcode(SubroutineCaller::class);

        $opcode->cpu->stackPointer = 0;
        $opcode->cpu->registerPC = 2;

        $opcode->execute(0x2222);

        $this->assertEquals(2, $opcode->cpu->stack[0]);
        $this->assertEquals(1, $opcode->cpu->stackPointer);
        $this->assertEquals(0x0222, $opcode->cpu->registerPC);
    }
}
