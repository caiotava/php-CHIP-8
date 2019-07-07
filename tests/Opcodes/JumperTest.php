<?php

namespace PHPEmulators\Chip8\Opcodes;

class JumperTest extends AbstractOpcodeTestCase
{
    public function testExecute()
    {
        $opcode = $this->createOpcode(Jumper::class);

        $opcode->execute(0x1222);

        $this->assertEquals(0x0222, $opcode->cpu->registerPC);
    }
}
