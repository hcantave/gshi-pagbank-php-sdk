<?php

namespace PagSeguro\Tests;

use PHPUnit\Framework\TestCase;
use PagSeguro\Domains\DirectPreApproval\Plan;

class PlanTest extends TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new Plan();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Plan::class, $this->obj);
    }

    public function testRequiredParameters(): void
    {
        $this->assertObjectHasAttribute('redirectURL', $this->obj);
        $this->assertObjectHasAttribute('reference', $this->obj);
        $this->assertObjectHasAttribute('preApproval', $this->obj);
        $this->assertObjectHasAttribute('reviewURL', $this->obj);
        $this->assertObjectHasAttribute('maxUsers', $this->obj);
        $this->assertObjectHasAttribute('receiver', $this->obj);
    }
}
