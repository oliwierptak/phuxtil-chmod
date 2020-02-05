<?php

declare(strict_types = 1);

namespace Phuxtil\Chmod;

interface DefinesInterface
{
    const CHMOD_SYMBOL_USER = 'u';
    const CHMOD_SYMBOL_GROUP = 'g';
    const CHMOD_SYMBOL_OTHER = 'o';

    const CHMOD_SYMBOL_READ = 'r';
    const CHMOD_SYMBOL_WRITE = 'w';
    const CHMOD_SYMBOL_EXECUTE = 'x';
}
