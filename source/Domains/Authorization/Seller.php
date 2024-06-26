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

namespace PagSeguro\Domains\Authorization;

use DateTime;
use InvalidArgumentException;
use PagSeguro\Domains\Address;
use PagSeguro\Domains\Document;
use PagSeguro\Domains\Phone;

/**
 * Class Seller
 *
 * @package PagSeguro\Domains\Authorization
 */
class Seller
{
    /**
     *
     *
     * @var DateTime
     */
    private $dateTime;
    /**
     * @var array
     */
    private $documents = [];
    /**
     * @var array
     */
    private $phones = [];

    /**
     * Person constructor.
     *
     * @param string   $name     * @param DateTime $birthDate
     * @param Address  $address
     */
    public function __construct(
        private $name = null,
        DateTime $birthDate = null,
        Document $document = null,
        Phone $phone = null,
        private ?Address $address = null
    ) {
        $this->dateTime = date('Y-m-d', $birthDate->getTimestamp());
        if (isset($document)) {
            $this->addDocuments($document);
        }
        if (isset($phone)) {
            $this->addPhones($phone);
        }
    }

    /**
     * @return array
     */
    public function addDocuments(Document $document)
    {
        $this->documents[] = $document;

        return $this->documents;
    }

    /**
     * @return array
     */
    public function addPhones(Phone $phone)
    {
        try {
            if (!$phone->getType()) {
                throw new InvalidArgumentException('Phone Type is required');
            };
        } catch (InvalidArgumentException $exception) {
            die($exception);
        }
        $this->phones[] = $phone;

        return $this->phones;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return array
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @return array
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @return null
     */
    public function getBirthDate()
    {
        return $this->dateTime;
    }
}
