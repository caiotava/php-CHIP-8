#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

$romPath = 'pong.chip8';
$romBuffer = file_get_contents($romPath);
$rom = new PHPEmulators\Chip8\Rom\RomStringBuffer($romBuffer);

print $rom->getSize().PHP_EOL;
printf('%x%s', $rom->readHex(4), PHP_EOL);
