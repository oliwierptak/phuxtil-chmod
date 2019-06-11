<?php

namespace Phuxtil\Chmod;

class ChmodFacade implements ChmodFacadeInterface
{
    /**
     * @var \Phuxtil\Chmod\ChmodFactory
     */
    protected $factory;

    protected function getFactory(): ChmodFactory
    {
        if ($this->factory === null) {
            $this->factory = new ChmodFactory();
        }

        return $this->factory;
    }

    public function setFactory(ChmodFactory $factory)
    {
        $this->factory = $factory;
    }

    public function validateByOctal(string $octal, string $owner, string $access): bool
    {
        return $this->getFactory()
            ->createPermissionValidator()
            ->validateByOctal($octal, $owner, $access);
    }

    public function validateBySymbol(string $symbol, string $owner, string $access): bool
    {
        return $this->getFactory()
            ->createPermissionValidator()
            ->validateBySymbol($symbol, $owner, $access);
    }

    public function applyUid(string $octal): string
    {
        return $this->getFactory()
            ->createPermissionAccessRight()
            ->applyUid($octal);
    }

    public function applyGid(string $octal): string
    {
        return $this->getFactory()
            ->createPermissionAccessRight()
            ->applyGid($octal);
    }

    public function applyUidAndGid(string $octal): string
    {
        return $this->getFactory()
            ->createPermissionAccessRight()
            ->applyUidAndGid($octal);
    }

    public function toArray(string $octal): array
    {
        return $this->getFactory()
            ->createPermissionArrayConverter()
            ->toArray($octal);
    }
}
