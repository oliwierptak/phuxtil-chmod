<?php

namespace Phuxtil\Chmod\Permission;

use Phuxtil\Chmod\DefinesInterface;

class Container
{
    /**
     * @var array
     */
    protected $symbolicModes = [
        DefinesInterface::CHMOD_SYMBOL_USER => [
            DefinesInterface::CHMOD_SYMBOL_READ => 00400,
            DefinesInterface::CHMOD_SYMBOL_WRITE => 00200,
            DefinesInterface::CHMOD_SYMBOL_EXECUTE => 00100,
        ],
        DefinesInterface::CHMOD_SYMBOL_GROUP => [
            DefinesInterface::CHMOD_SYMBOL_READ => 00040,
            DefinesInterface::CHMOD_SYMBOL_WRITE => 00020,
            DefinesInterface::CHMOD_SYMBOL_EXECUTE => 00010,
        ],
        DefinesInterface::CHMOD_SYMBOL_OTHER => [
            DefinesInterface::CHMOD_SYMBOL_READ => 00004,
            DefinesInterface::CHMOD_SYMBOL_WRITE => 00002,
            DefinesInterface::CHMOD_SYMBOL_EXECUTE => 00001,
        ],
    ];

    /**
     * @var array
     */
    protected $octalModes = [
        '---' => 0, //none
        '--x' => 1, //execute
        '-w-' => 2, //write
        '-wx' => 3, //write/execute
        'r--' => 4, //read
        'r-x' => 5, //read/execute
        'rw-' => 6, //read/write
        'rwx' => 7, //read/write/execute
    ];

    public function getSymbolicModes(): array
    {
        return $this->symbolicModes;
    }

    public function getOctalModes(): array
    {
        return $this->octalModes;
    }
}
