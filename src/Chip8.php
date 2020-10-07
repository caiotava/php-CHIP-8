<?php

namespace PHPEmulators\Chip8;

use PHPEmulators\Chip8\CPU;
use PHPEmulators\Chip8\Rom\Rom;

class Chip8
{
    private $rom;
    public $memory;
    public $graphicMemory;
    public $keys;
    public $interruptDelayTime = 0;
    public $interruptSoundTime = 0;
    public $drawFlag = false;

    const SCREEN_WIDTH = 64;
    const SCREEN_HEIGHT = 32;
    const MEMORY_SIZE = 4096;
    const MEMORY_FONT_POSITION = 0;
    const MEMORY_ROM_POSITION = 512;

    public function __construct(Rom $rom)
    {
        $this->rom = $rom;

        $this->initializeMemories();
        $this->initializeInput();
        $this->loadFontSetToMemory();
        $this->loadRomToMemory();
    }

    private function initializeMemories()
    {
        $this->memory = new Memory($this::MEMORY_SIZE);
        $this->graphicMemory = new Memory($this::SCREEN_WIDTH * $this::SCREEN_HEIGHT);
    }

    private function loadFontSetToMemory()
    {
        $this->memory->copy(Font::SET, $this::MEMORY_FONT_POSITION);
    }

    private function loadRomToMemory()
    {
        $this->memory->copy($this->rom->toArrayHex(), $this::MEMORY_ROM_POSITION);
    }

    private function initializeInput()
    {
        $this->keys = array_fill(0, 16, 0);
    }

    public function run()
    {
        $cpu = new CPU($this);
    }
}
