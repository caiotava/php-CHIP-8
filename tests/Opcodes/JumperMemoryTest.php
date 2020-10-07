<?php

namespace PHPEmulators\Chip8\Opcodes;

class JumperMemoryTest extends AbstractOpcodeTestCase
{
    public function testExecute()
    {
        $opcode = $this->createOpcode(JumperMemory::class);

        $opcode->cpu->registers[0] = 1;

        $opcode->execute(0xB222);

        $this->assertEquals(0x223, $opcode->cpu->registerPC);
    }
}
