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

namespace PagSeguro\Parsers\PreApproval\Search\Code;

use PagSeguro\Domains\Address;
use PagSeguro\Domains\Phone;
use PagSeguro\Domains\PreApproval\Sender;
use PagSeguro\Enum\Properties\Current;
use PagSeguro\Parsers\Error;
use PagSeguro\Parsers\Parser;
use PagSeguro\Resources\Http;

/**
 * Class Request
 *
 * @package PagSeguro\Parsers\PreApproval\Search\Code
 */
class Request extends Error implements Parser
{
    /**
     * @param  $code
     * @return array
     */
    public static function getData($code)
    {
        $data = [];
        $current = new Current();

        if (!is_null($code)) {
            $data[$current::TRANSACTION_CODE] = $code;
        }
        return $data;
    }

    /**
     *
     *
     * @return Response
     */
    public static function success(Http $http)
    {
        $xml = simplexml_load_string($http->getResponse());
        $response = new Response();
        $response->setName(current($xml->name))
            ->setCode(current($xml->code))
            ->setDate(current($xml->date))
            ->setTracker(current($xml->tracker))
            ->setStatus(current($xml->status))
            ->setReference(current($xml->reference))
            ->setLastEventDate(current($xml->lastEventDate))
            ->setCharge(current($xml->charge))
            ->setSender(
                (new Sender())->setName(current($xml->sender->name))
                    ->setEmail(current($xml->sender->email))
                    ->setPhone(
                        (new Phone())->setAreaCode(current($xml->sender->phone->areaCode))
                            ->setNumber(current($xml->sender->phone->areaCode))
                    )->setAddress(
                        (new Address())->setStreet(current($xml->sender->address->street))
                            ->setNumber(current($xml->sender->address->number))
                            ->setComplement(current($xml->sender->address->complement))
                            ->setDistrict(current($xml->sender->address->district))
                            ->setCity(current($xml->sender->address->city))
                            ->setState(current($xml->sender->address->state))
                            ->setCountry(current($xml->sender->address->country))
                            ->setPostalCode(current($xml->sender->address->postalCode))
                    )
            );


        return $response;
    }

    /**
     *
     *
     * @return \PagSeguro\Domains\Error
     */
    public static function error(Http $http)
    {
        return parent::error($http);
    }
}
