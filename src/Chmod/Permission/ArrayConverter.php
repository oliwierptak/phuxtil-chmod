<?php

declare(strict_types = 1);

namespace Phuxtil\Chmod\Permission;

class ArrayConverter
{
    /**
     * @var \Phuxtil\Chmod\Permission\Validator
     */
    protected $validator;

    /**
     * @var array
     */
    protected $symbolicModes = [];

    /**
     * @var array
     */
    protected $octalModes = [];

    public function __construct(Validator $validator, array $symbolicModes, array $octalModes)
    {
        $this->validator = $validator;
        $this->symbolicModes = $symbolicModes;
        $this->octalModes = $octalModes;
    }

    /**
     * @param string $octal Octal values, eg. 0644, 0755
     *
     * @return array
     */
    public function toArray(string $octal): array
    {
        if (!ctype_xdigit($octal)) {
            return [];
        }

        $perms = octdec($octal);
        if ($perms <= 0) {
            return [];
        }

        $flags = [];
        foreach ($this->symbolicModes as $owner => $permissions) {
            foreach ($permissions as $access => $octalValue) {
                $flags[$owner][$access] = $this->validator->validate($octal, $owner, $access) ? $access : '-';
            }
        }

        return $flags;
    }
}
