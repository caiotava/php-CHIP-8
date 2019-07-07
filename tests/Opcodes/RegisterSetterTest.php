<?php

namespace PHPEmulators\Chip8\Opcodes;

class RegisterSetterTest extends AbstractOpcodeTestCase
{
    public function testExecuteSimpleSet()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[1] = 22;

        $opcode->execute(0x8010);

        $this->assertEquals(22, $opcode->cpu->registers[0]);
    }

    public function testExecuteBitwiseOr()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[0] = 1;
        $opcode->cpu->registers[1] = 4;

        $opcode->execute(0x8011);

        $this->assertEquals(5, $opcode->cpu->registers[0]);
    }

    public function testExecuteBitwiseAnd()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[0] = 2;
        $opcode->cpu->registers[1] = 3;

        $opcode->execute(0x8012);

        $this->assertEquals(2, $opcode->cpu->registers[0]);
    }

    public function testExecuteBitwiseXor()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[0] = 3;
        $opcode->cpu->registers[1] = 6;

        $opcode->execute(0x8013);

        $this->assertEquals(5, $opcode->cpu->registers[0]);
    }

    public function testExecuteAdd()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[1] = 22;

        $opcode->execute(0x8014);

        $this->assertEquals(22, $opcode->cpu->registers[0]);
        $this->assertEquals(0, $opcode->cpu->registers[0xF]);
    }

    public function testExecuteAddWithCarry()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[1] = 0xFA;

        $opcode->execute(0x8014);

        $this->assertEquals(0xFA, $opcode->cpu->registers[0]);
        $this->assertEquals(1, $opcode->cpu->registers[0xF]);
    }

    public function testExecuteSubtraction()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[0] = 22;
        $opcode->cpu->registers[1] = 10;

        $opcode->execute(0x8015);

        $this->assertEquals(12, $opcode->cpu->registers[0]);
        $this->assertEquals(0, $opcode->cpu->registers[0xF]);
    }

    public function testExecuteSubtractionWithBorrow()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[0] = 10;
        $opcode->cpu->registers[1] = 22;

        $opcode->execute(0x8015);

        $this->assertEquals(-12, $opcode->cpu->registers[0]);
        $this->assertEquals(1, $opcode->cpu->registers[0xF]);
    }

    public function testExecuteShiftRight()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[0] = 3;

        $opcode->execute(0x8006);

        $this->assertEquals(1, $opcode->cpu->registers[0]);
        $this->assertEquals(1, $opcode->cpu->registers[0xF]);
    }

    public function testExecuteSubtractionOnSource()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[0] = 1;
        $opcode->cpu->registers[1] = 2;

        $opcode->execute(0x8017);

        $this->assertEquals(1, $opcode->cpu->registers[0]);
        $this->assertEquals(0, $opcode->cpu->registers[0xF]);
    }

    public function testExecuteShiftLeft()
    {
        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->cpu->registers[0] = 128;

        $opcode->execute(0x800E);

        $this->assertEquals(256, $opcode->cpu->registers[0]);
        $this->assertEquals(1, $opcode->cpu->registers[0xF]);
    }

    public function testInvalidOpcode()
    {
        $this->expectException(\InvalidArgumentException::class);

        $opcode = $this->createOpcode(RegisterSetter::class);

        $opcode->execute(0x800F);
    }
}
