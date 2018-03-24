<?php

namespace PHPEmulators\Chip8\Rom;

interface Rom
{
    public function getSize(): int;
    public function read(int $index): string;
    public function readHex(int $index): int;
    public function toArrayHex(): array;
}
