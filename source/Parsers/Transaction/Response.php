<?php
/**
 * 2007-2016 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    PagSeguro Internet Ltda.
 * @copyright 2007-2016 PagSeguro Internet Ltda.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 *
 */

namespace PagSeguro\Parsers\Transaction;

use PagSeguro\Parsers\Response\CreditorFees;
use PagSeguro\Parsers\Response\Currency;
use PagSeguro\Parsers\Response\Item;
use PagSeguro\Parsers\Response\PaymentMethod;
use PagSeguro\Parsers\Response\Sender;
use PagSeguro\Parsers\Response\Shipping;

/**
 * Class Response
 * @package PagSeguro\Parsers\Transaction
 */
class Response
{
    use Currency;
    use CreditorFees;
    use Item;
    use PaymentMethod;
    use Sender;
    use Shipping;

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
     * @var
     */
    private $status;
    /**
     * @var
     */
    private $lastEventDate;
    /**
     * @var
     */
    private $installmentCount;

    /**
     * Only present when the status = 7
     * @var string
     */
    private $cancelationSource;

    /**
     * @var
     */
    private $promoCode;

    public function getCancelationSource()
    {
        return $this->cancelationSource;
    }

    public function setCancelationSource($cancelationSource)
    {
        $this->cancelationSource = $cancelationSource;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstallmentCount()
    {
        return $this->installmentCount;
    }

    /**
     * @return Response
     */
    public function setInstallmentCount(mixed $installmentCount)
    {
        $this->installmentCount = $installmentCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return Response
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
     * @return Response
     */
    public function setDate(mixed $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastEventDate()
    {
        return $this->lastEventDate;
    }

    /**
     * @return Response
     */
    public function setLastEventDate(mixed $lastEventDate)
    {
        $this->lastEventDate = $lastEventDate;
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
     * @return Response
     */
    public function setReference(mixed $reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Response
     */
    public function setStatus(mixed $status)
    {
        $this->status = $status;
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
     * @return Response
     */
    public function setType(mixed $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * @return Response
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;
        return $this;
    }
}
