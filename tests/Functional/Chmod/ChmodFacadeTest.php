<?php

namespace PhuxtilTests\Functional\Chmod;

use PHPUnit\Framework\TestCase;
use Phuxtil\Chmod\ChmodFacade;
use Phuxtil\Chmod\ChmodFactory;

class ChmodFacadeTest extends TestCase
{
    public function test_isReadable()
    {
        $facade = new ChmodFacade();

        $this->assertTrue($facade->isReadable('0644'));
        $this->assertTrue($facade->isReadable('0343'));
        $this->assertTrue($facade->isReadable('0334'));
        $this->assertFalse($facade->isReadable('0333'));
    }

    public function test_isWritable()
    {
        $facade = new ChmodFacade();

        $this->assertTrue($facade->isWritable('0644'));
        $this->assertTrue($facade->isWritable('0343'));
        $this->assertTrue($facade->isWritable('0334'));
        $this->assertTrue($facade->isWritable('0222'));
        $this->assertFalse($facade->isWritable('0111'));
    }

    public function test_isExecutable()
    {
        $facade = new ChmodFacade();

        $this->assertFalse($facade->isExecutable('0644'));
        $this->assertTrue($facade->isExecutable('0343'));
        $this->assertTrue($facade->isExecutable('0334'));
        $this->assertFalse($facade->isExecutable('0222'));
        $this->assertTrue($facade->isExecutable('0111'));
        $this->assertFalse($facade->isExecutable('0000'));
    }

    public function test_validate()
    {
        $facade = new ChmodFacade();
        $facade->setFactory(new ChmodFactory());

        $this->assertTrue($facade->validate('0644', 'u', 'r'));
        $this->assertTrue($facade->validate('0644', 'g', 'r'));
        $this->assertFalse($facade->validate('0644', 'g', 'w'));
        $this->assertFalse($facade->validate('0644', 'o', 'w'));

        $this->assertTrue($facade->validate('0755', 'u', 'r'));
        $this->assertTrue($facade->validate('0755', 'g', 'r'));
        $this->assertFalse($facade->validate('0755', 'g', 'w'));
        $this->assertFalse($facade->validate('0755', 'o', 'w'));
    }

    public function test_validateByOctal_should_return_false_when_invalid_octal()
    {
        $facade = new ChmodFacade();

        $this->assertFalse($facade->validate('invalid', 'u', 'r'));
    }

    public function test_validateByOctal_should_return_false_when_invalid_owner_or_access()
    {
        $facade = new ChmodFacade();

        $this->assertFalse($facade->validate('0664', 'invalid', 'invalid'));
    }

    public function test_validateBySymbol()
    {
        $facade = new ChmodFacade();

        $this->assertTrue($facade->validateBySymbol('-rw-r--r--', 'u', 'r'));
        $this->assertTrue($facade->validateBySymbol('-rw-r--r--', 'u', 'w'));
        $this->assertFalse($facade->validateBySymbol('-rw-r--r--', 'u', 'x'));

        $this->assertTrue($facade->validateBySymbol('-rw-r--r--', 'g', 'r'));
        $this->assertFalse($facade->validateBySymbol('-rw-r--r--', 'g', 'w'));
        $this->assertFalse($facade->validateBySymbol('-rw-r--r--', 'g', 'x'));

        $this->assertTrue($facade->validateBySymbol('-rw-r--r--', 'o', 'r'));
        $this->assertFalse($facade->validateBySymbol('-rw-r--r--', 'o', 'w'));
        $this->assertFalse($facade->validateBySymbol('-rw-r--r--', 'o', 'x'));
    }

    public function test_validateBySymbol_should_return_false_when_invalid_symbol()
    {
        $facade = new ChmodFacade();

        $this->assertFalse($facade->validateBySymbol('invalid', 'u', 'r'));
    }

    public function test_validateBySymbol_should_return_false_when_invalid_owner_or_access()
    {
        $facade = new ChmodFacade();

        $this->assertFalse($facade->validateBySymbol('-rw-r--r--', 'invalid', 'invalid'));
    }

    public function test_applyUid()
    {
        $facade = new ChmodFacade();

        $value = $facade->applyUid('0644');

        $this->assertEquals('4644', $value);
    }

    public function test_applyGid()
    {
        $facade = new ChmodFacade();

        $value = $facade->applyGid('0644');

        $this->assertEquals('2644', $value);
    }

    public function test_applyUidAndGid()
    {
        $facade = new ChmodFacade();

        $value = $facade->applyUidAndGid('0644');

        $this->assertEquals('6644', $value);
    }

    public function test_toArray_0644()
    {
        $facade = new ChmodFacade();

        $flags = $facade->toArray('0644');

        $this->assertEquals([
            'u' => [
                'r' => 'r',
                'w' => 'w',
                'x' => '-',
            ],
            'g' => [
                'r' => 'r',
                'w' => '-',
                'x' => '-',
            ],
            'o' => [
                'r' => 'r',
                'w' => '-',
                'x' => '-',
            ]
        ], $flags);
    }

    public function test_toArray_0775()
    {
        $facade = new ChmodFacade();

        $flags = $facade->toArray('0775');

        $this->assertEquals([
            'u' => [
                'r' => 'r',
                'w' => 'w',
                'x' => 'x',
            ],
            'g' => [
                'r' => 'r',
                'w' => 'w',
                'x' => 'x',
            ],
            'o' => [
                'r' => 'r',
                'w' => '-',
                'x' => 'x',
            ]
        ], $flags);
    }


    public function test_toArray_should_return_false_when_invalid_permissions()
    {
        $facade = new ChmodFacade();

        $flags = $facade->toArray('invalid');

        $this->assertEmpty($flags);
    }
}
