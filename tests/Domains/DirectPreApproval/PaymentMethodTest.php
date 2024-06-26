<?php

namespace PagSeguro\Tests;

use PHPUnit\Framework\TestCase;
use PagSeguro\Domains\DirectPreApproval\PaymentMethod;

class PaymentMethodTest extends TestCase
{
    private $obj;

    protected function setUp(): void
    {
        $this->obj = new PaymentMethod();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(PaymentMethod::class, $this->obj);
    }

    public function testRequiredParameters(): void
    {
        $this->assertObjectHasAttribute('type', $this->obj);
    }
}
