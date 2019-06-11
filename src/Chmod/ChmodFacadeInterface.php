<?php

namespace Phuxtil\Chmod;

interface ChmodFacadeInterface
{
    public function setFactory(ChmodFactory $factory);

    /**
     * @param string $octal Octal values, eg. 0644, 0755
     * @param string $owner u|g|o
     * @param string $access r|w|x
     *
     * @return bool
     */
    public function validateByOctal(string $octal, string $owner, string $access): bool;

    /**
     * @param string $symbol eg. -rw-r--r--
     * @param string $owner u|g|o
     * @param string $access r|w|x
     *
     * @return bool
     */
    public function validateBySymbol(string $symbol, string $owner, string $access): bool;

    /**
     * @param string $octal Octal values, eg. 0644, 0755
     *
     * @return string
     */
    public function applyUid(string $octal): string;

    /**
     * @param string $octal Octal values, eg. 0644, 0755
     *
     * @return string
     */
    public function applyGid(string $octal): string;

    /**
     * @param string $octal Octal values, eg. 0644, 0755
     *
     * @return string
     */
    public function applyUidAndGid(string $octal): string;

    /**
     * @param string $octal Octal values, eg. 0644, 0755
     *
     * @return array
     */
    public function toArray(string $octal): array;
}
