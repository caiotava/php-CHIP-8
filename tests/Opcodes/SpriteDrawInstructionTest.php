<?php

namespace PHPEmulators\Chip8\Opcodes;

class SpriteDrawInstructionTest extends AbstractOpcodeTestCase
{
    public function testExecute()
    {
        $opcode = $this->createOpcode(SpriteDrawInstruction::Class);

        $opcode->cpu->registerI = 1;
        $opcode->cpu->memory[2] = 1;

        $opcode->execute(0xD111);

        $this->assertEquals(1, $opcode->chipset->graphicMemory[1]);
        $this->assertEquals(2, $opcode->cpu->registerPC);
        $this->assertEquasl(1, end($opcode->cpu->registers));
    }
}
