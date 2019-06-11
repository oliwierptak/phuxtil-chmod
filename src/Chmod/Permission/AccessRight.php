<?php

namespace Phuxtil\Chmod\Permission;

class AccessRight
{
    public function applyUid(string $octal): string
    {
        $perms = intval($octal) + 4000;

        return $perms;
    }

    public function applyGid(string $octal): string
    {
        $perms = intval($octal) + 2000;

        return $perms;
    }

    public function applyUidAndGid(string $octal): string
    {
        $perms = intval($octal) + 6000;

        return $perms;
    }
}
