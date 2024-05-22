<?php

namespace PagSeguro\Parsers\Transaction\Search;

/**
 * Class Transactions
 * @package PagSeguro\Parsers\Transaction\Search
 */
abstract class Transactions
{
    /**
     * @var
     */
    private $date;
    /**
     * @var
     */
    private $code;
    /**
     * @var
     */
    private $reference;
    /**
     * @var
     */
    private $type;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return Transactions
     */
    public function setCode(mixed $code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Transactions
     */
    public function setDate(mixed $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return Transactions
     */
    public function setReference(mixed $reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Transactions
     */
    public function setType(mixed $type)
    {
        $this->type = $type;
        return $this;
    }
}
