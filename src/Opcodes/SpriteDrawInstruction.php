<?php

namespace PHPEmulators\Chip8\Opcodes;

class SpriteDrawInstruction extends AbstractOpcode
{
    private $code;

    public function execute(int $code): void
    {
        $this->code = $code;
        $sprites = $this->getSpritesToDraw();

        $this->clearHighestRegister();
        $this->drawSpritesToGraphicMemory($sprites);

        $this->cpu->registerPC += 2;
        $this->chipset->drawFlag = true;
    }

    private function getSpritesToDraw(): array
    {
        $height = $this->code & 0x000F;
        $startIndex = $this->cpu->registerI;
        $endIndex = $startIndex + $height;
        $sprites = [];

        for ($i = $startIndex; $i < $endIndex; $i++) {
            $sprites[] = $this->chipset->memory[$i];
        }

        return $sprites;
    }

    private function clearHighestRegister():void
    {
        $highestIndex = count($this->cpu->registers) - 1;

        $this->cpu->registers[$highestIndex] = 0;
    }

    private function drawSpritesToGraphicMemory(array $sprites): void
    {
        foreach ($sprites as $spriteIndex => $sprite) {
            $pixels = $this->copySpritePixelToGraphicMemory($sprite, $spriteIndex);
        }
    }

    private function copySpritePixelToGraphicMemory($sprite, $spriteIndex): void
    {
        $registerIndexX = ($this->code & 0x0F00) >> 8;
        $registerIndexY = ($this->code & 0x00F0) >> 4;
        $registerX = $this->cpu->registers[$registerIndexX];
        $registerY = $this->cpu->registers[$registerIndexY];

        for ($pixelIndex = 0; $pixelIndex < 8; $pixelIndex++) {
            if (!$this->isSpritePixelActive($sprite, $pixelIndex)) {
                continue;
            }

            $memoryIndex = ($registerX + $pixelIndex) + (($registerY + $spriteIndex) * 64);

            if ($this->chipset->graphicMemory[$memoryIndex]) {
                $highestIndex = count($this->cpu->registers); - 1;

                $this->cpu->registers[$highestIndex] = 0;
            }

            $this->chipset->graphicMemory[$memoryIndex] ^= 1;
        }
    }

    private function isSpritePixelActive($sprite, $pixelIndex)
    {
        return $sprite & (0x80 >> $pixelIndex) != 0;
    }
}
