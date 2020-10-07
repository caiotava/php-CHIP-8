<?php

namespace PHPEmulators\Chip8\Opcodes;

class RegisterSetter extends AbstractOpcode
{
    const MAX_REGISTER = 0xF;

    private $registerDestination;
    private $registerSource;

    public function execute(int $code): void
    {
        $this->registerDestination = ($code & 0x0F00) >> 8;
        $this->registerSource = ($code & 0x00F0) >> 4;

        $this->executeCodeOperation($code);

        $this->cpu->registerPC += 2;
    }

    private function executeCodeOperation(int $code): void
    {
        $operationCode = $code & 0x000F;
        $registerDestination = $this->registerDestination;
        $registerSource = $this->registerSource;
        $registerDestinationValue = $this->cpu->registers[$registerDestination];
        $registerSourceValue = $this->cpu->registers[$registerSource];

        switch ($operationCode) {
            case 0x0000:
                $this->cpu->registers[$registerDestination] = $registerSourceValue;
                break;
            case 0x0001:
                $this->cpu->registers[$registerDestination] |= $registerSourceValue;
                break;
            case 0x0002:
                $this->cpu->registers[$registerDestination] &= $registerSourceValue;
                break;
            case 0x0003:
                $this->cpu->registers[$registerDestination] ^= $registerSourceValue;
                break;
            case 0x0004:
                $this->cpu->registers[$registerDestination] += $registerSourceValue;

                $isCarry = $registerSourceValue > (0xFF - $this->cpu->registers[$registerDestination]);

                $this->cpu->registers[$this::MAX_REGISTER] = (int) $isCarry;
                break;
            case 0x0005:
                $isBorrow = $registerSourceValue > $registerDestinationValue;

                $this->cpu->registers[$registerDestination] -= $registerSourceValue;
                $this->cpu->registers[$this::MAX_REGISTER] = (int) $isBorrow;
                break;
            case 0x0006:
                $this->cpu->registers[$this::MAX_REGISTER] = $registerDestinationValue & 0x1;
                $this->cpu->registers[$registerDestination] = $registerDestinationValue >> 1;
                break;
            case 0x0007:
                $isBorrow = $registerDestinationValue > $registerSourceValue;

                $this->cpu->registers[$registerDestination] = $registerSourceValue - $registerDestinationValue;
                $this->cpu->registers[$this::MAX_REGISTER] = (int) $isBorrow;
                break;
            case 0x000E:
                $this->cpu->registers[$this::MAX_REGISTER] = $registerDestinationValue >> 7;
                $this->cpu->registers[$registerDestination] = $registerDestinationValue << 1;
                break;
            default:
                $this->throwInvalidOpCode();
        }
    }
}
