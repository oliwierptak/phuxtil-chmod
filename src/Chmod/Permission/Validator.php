<?php

namespace Phuxtil\Chmod\Permission;

class Validator
{
    /**
     * @var array
     */
    protected $symbolicModes = [];

    /**
     * @var array
     */
    protected $octalModes = [];

    public function __construct(array $symbolicModes, array $octalModes)
    {
        $this->symbolicModes = $symbolicModes;
        $this->octalModes = $octalModes;
    }

    /**
     * @param string $octal Octal values, eg. 0644, 0755
     * @param string $owner u|g|o
     * @param string $access r|w|x
     *
     * @return bool
     */
    public function validateByOctal(string $octal, string $owner, string $access): bool
    {
        if (!isset($this->symbolicModes[$owner]) || !isset($this->symbolicModes[$owner][$access])) {
            return false;
        }

        $perms = octdec($octal);
        if ($perms <= 0) {
            return false;
        }

        return ($perms & $this->symbolicModes[$owner][$access]) > 0;
    }

    /**
     * @param string $symbol eg. -rw-r--r--
     * @param string $owner u|g|o
     * @param string $access r|w|x
     *
     * @return bool
     */
    public function validateBySymbol(string $symbol, string $owner, string $access): bool
    {
        if (!isset($this->symbolicModes[$owner]) || !isset($this->symbolicModes[$owner][$access])) {
            return false;
        }

        $userLand = substr($symbol, 1, 3);
        $groupLand = substr($symbol, 4, 3);
        $otherLand = substr($symbol, 7, 3);

        $userMode = $this->octalModes[$userLand] ?? 0;
        $groupMode = $this->octalModes[$groupLand] ?? 0;
        $otherMode = $this->octalModes[$otherLand] ?? 0;

        $octal = sprintf(
            '0%d%d%d',
            $userMode,
            $groupMode,
            $otherMode
        );

        return $this->validateByOctal($octal, $owner, $access);
    }
}
