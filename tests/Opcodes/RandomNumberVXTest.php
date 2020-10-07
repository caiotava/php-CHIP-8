<?php

namespace PHPEmulators\Chip8\Opcodes;

class RandomNumberVXTest extends AbstractOpcodeTestCase
{
    public function testExecute()
    {
        $opcode = $this->createOpcode(RandomNumberVX::class);

        $opcode->execute(0xA001);

        $expectedValue = (rand() % RandomNumberVX::MAX_RAND_NUMBER) & (1);


        $this->assertEquals($expectedValue, $opcode->cpu->registers[0]);
        $this->assertEquals(2, $opcode->cpu->registerPC);
        $this->assertLessThanOrEqual(RandomNumberVX::MAX_RAND_NUMBER, $opcode->cpu->registers[0]);
    }
}

function rand()
{
    return 4000;
}
