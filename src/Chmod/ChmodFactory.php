<?php

declare(strict_types = 1);

namespace Phuxtil\Chmod;

use Phuxtil\Chmod\Permission\AccessRight;
use Phuxtil\Chmod\Permission\ArrayConverter;
use Phuxtil\Chmod\Permission\Container;
use Phuxtil\Chmod\Permission\Validator;

class ChmodFactory
{
    public function createPermissionAccessRight(): AccessRight
    {
        return new AccessRight();
    }

    public function createPermissionArrayConverter(): ArrayConverter
    {
        $container = $this->createPermissionContainer();

        return new ArrayConverter(
            $this->createPermissionValidator(),
            $container->getSymbolicModes(),
            $container->getOctalModes()
        );
    }

    public function createPermissionContainer(): Container
    {
        return new Container();
    }

    public function createPermissionValidator(): Validator
    {
        $container = $this->createPermissionContainer();

        return new Validator(
            $container->getSymbolicModes(),
            $container->getOctalModes()
        );
    }
}
