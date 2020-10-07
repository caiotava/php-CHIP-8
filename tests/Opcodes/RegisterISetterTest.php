<?php

namespace PHPEmulators\Chip8\Opcodes;

class RegisterISetterTest extends AbstractOpcodeTestCase
{
    public function testExecute()
    {
        $opcode = $this->createOpcode(RegisterISetter::class);

        $opcode->execute(0xA222);

        $this->assertEquals(0x0222, $opcode->cpu->registerI);
        $this->assertEquals(2, $opcode->cpu->registerPC);
    }
}
