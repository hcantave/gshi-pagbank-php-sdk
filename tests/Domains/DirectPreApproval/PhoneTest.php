<?php

namespace PagSeguro\Tests;

use PHPUnit\Framework\TestCase;
use PagSeguro\Domains\DirectPreApproval\Phone;

class PhoneTest extends TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new Phone();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Phone::class, $this->obj);
    }

    public function testParameters(): void
    {
        $this->assertObjectHasAttribute('areaCode', $this->obj);
        $this->assertObjectHasAttribute('number', $this->obj);
    }
}
