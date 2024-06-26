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

namespace PagSeguro\Parsers;

use PagSeguro\Domains\Requests\Requests;
use PagSeguro\Helpers\Characters;

/**
 * Trait Sender
 *
 * @package PagSeguro\Parsers
 */
trait Sender
{
    /**
     * @param  $properties
     * @return array
     */
    public static function getData(Requests $requests, $properties)
    {
        $data = [];
        // sender
        if (!is_null($requests->getSender())) {
            if (!is_null($requests->getSender()->getName())) {
                $data[$properties::SENDER_NAME] = $requests->getSender()->getName();
            }
            if (!is_null($requests->getSender()->getEmail())) {
                $data[$properties::SENDER_EMAIL] = $requests->getSender()->getEmail();
            }
            // phone
            if (!is_null($requests->getSender()->getPhone())) {
                $data = array_merge($data, self::phone($requests, $properties));
            }
            // documents
            if (!is_null($requests->getSender()->getDocuments())) {
                $data = array_merge($data, self::documents($requests, $properties));
            }
            // ip (only used in direct payments)
            if (method_exists($requests->getSender(), 'getIp') && !is_null($requests->getSender()->getIp())) {
                $data[$properties::SENDER_IP] = $requests->getSender()->getIp();
            }
            // hash (only used in direct payments)
            if (method_exists($requests->getSender(), 'getHash') && !is_null($requests->getSender()->getHash())) {
                $data[$properties::SENDER_HASH] = $requests->getSender()->getHash();
            }
        }
        return $data;
    }

    /**
     * @param  $request
     * @param  $properties
     * @return array
     */
    private static function phone($request, $properties)
    {
        $data = [];
        if (!is_null($request->getSender()->getPhone()->getAreaCode())) {
            $data[$properties::SENDER_PHONE_AREA_CODE] = $request->getSender()->getPhone()->getAreaCode();
        }
        if (!is_null($request->getSender()->getPhone()->getNumber())) {
            $data[$properties::SENDER_PHONE_NUMBER] = $request->getSender()->getPhone()->getNumber();
        }
        return $data;
    }

    /**
     * @param  $payment
     * @param  $properties
     * @return array
     */
    private static function documents($payment, $properties)
    {
        $data = [];
        $documents = $payment->getSender()->getDocuments();

        if (is_array($documents) && count($documents) == 1) {
            foreach ($documents as $document) {
                if (!is_null($document)) {
                    $document->getType() == "CPF" ?
                        $data[$properties::SENDER_DOCUMENT_CPF] =
                            Characters::hasSpecialChars($document->getIdentifier()) :
                        $data[$properties::SENDER_DOCUMENT_CNPJ] =
                            Characters::hasSpecialChars($document->getIdentifier());
                }
            }
        }
        return $data;
    }
}
