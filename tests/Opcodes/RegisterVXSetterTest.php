<?php

namespace PHPEmulators\Chip8\Opcodes;

class RegisterVXSetterTest extends AbstractOpcodeTestCase
{
    /**
     * @dataProvider dataProviderTestExecute
     */
    public function testExecute($code)
    {
        $opcode = $this->createOpcode(RegisterVXSetter::class);

        $opcode->cpu->registerPC = 0;

        $opcode->execute($code);

        $this->assertEquals(0x0022, $opcode->cpu->registers[0]);
        $this->assertEquals(2, $opcode->cpu->registerPC);
    }

    public function dataProviderTestExecute()
    {
        return [
            [0x6022],
            [0x7022],
        ];
    }
}
