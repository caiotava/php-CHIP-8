#!/bin/bash
docker run -it -v "$PWD":/usr/src/chip8 -w /usr/src/chip8 caiotava/docker-php7-ncurses /bin/bash
