<?php

namespace PHPEmulators\Chip8\Opcodes;

class JumperInstructionTest extends AbstractOpcodeTestCase
{
    /**
     * @dataProvider dataProviderTestExecute
     */
    public function testExecute($code, $isSkipped)
    {
        $opcode = $this->createOpcode(JumperInstruction::class);

        $opcode->cpu->registers[0] = 0x0022;
        $opcode->cpu->registers[1] = 0;

        $opcode->execute($code);

        $expectedRegisterPC = $isSkipped ? 4 : 2;

        $this->assertEquals($expectedRegisterPC, $opcode->cpu->registerPC);
    }

    public function dataProviderTestExecute()
    {
        return [
            [0x3022, true],
            [0x3023, false],
            [0x4023, true],
            [0x4022, false],
            [0x5000, true],
            [0x5010, false],
            [0x9010, true],
            [0x9000, false],
        ];
    }
}
