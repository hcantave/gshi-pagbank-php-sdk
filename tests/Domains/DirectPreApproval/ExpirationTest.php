<?php

namespace PagSeguro\Tests;

use PHPUnit\Framework\TestCase;
use PagSeguro\Domains\DirectPreApproval\Expiration;

class ExpirationTest extends TestCase
{
    private $obj;

    protected function setUp(): void
    {
        $this->obj = new Expiration();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Expiration::class, $this->obj);
    }

    public function testRequiredParameters(): void
    {
        $this->assertObjectHasAttribute('value', $this->obj);
        $this->assertObjectHasAttribute('unit', $this->obj);
    }
}
