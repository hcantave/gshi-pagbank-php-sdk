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
 */

namespace PagSeguro\Parsers\PreApproval\Search;

/**
 * Class Response
 *
 * @package PagSeguro\Parsers\PreApproval\Search
 */
class Response
{
    private $name;
    private $code;
    private $date;
    private $tracker;
    private $status;
    private $reference;
    private $lastEventDate;
    private $charge;

    /**
     * @return mixed
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @return Response
     */
    public function setCharge(mixed $charge)
    {
        $this->charge = $charge;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Response
     */
    public function setName(mixed $name)
    {
        $this->name = $name;
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
    public function getTracker()
    {
        return $this->tracker;
    }

    /**
     * @return Response
     */
    public function setTracker(mixed $tracker)
    {
        $this->tracker = $tracker;
        return $this;
    }
}
