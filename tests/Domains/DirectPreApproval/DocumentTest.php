<?php

namespace PagSeguro\Tests;

use PHPUnit\Framework\TestCase;
use PagSeguro\Domains\DirectPreApproval\Document;

class DocumentTest extends TestCase
{
    private $obj;

    protected function setUp(): void
    {
        $this->obj = new Document();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Document::class, $this->obj);
    }

    public function testRequiredParameters(): void
    {
        $this->assertObjectHasAttribute('type', $this->obj);
        $this->assertObjectHasAttribute('value', $this->obj);
    }
}
