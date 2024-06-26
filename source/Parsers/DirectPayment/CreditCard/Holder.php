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

namespace PagSeguro\Parsers\DirectPayment\CreditCard;

use PagSeguro\Domains\Requests\Requests;
use PagSeguro\Helpers\Characters;

/**
 * Trait Holder
 *
 * @package PagSeguro\Parsers\DirectPayment\CreditCard
 */
trait Holder
{
    /**
     * @param  $properties
     * @return array
     */
    public static function getData(Requests $requests, $properties)
    {
        $data = [];
        // sender
        if (!is_null($requests->getHolder())) {
            if (!is_null($requests->getHolder()->getName())) {
                $data[$properties::CREDIT_CARD_HOLDER_NAME] = $requests->getHolder()->getName();
            }
            if (!is_null($requests->getHolder()->getBirthDate())) {
                $data[$properties::CREDIT_CARD_HOLDER_BIRTH_DATE] = $requests->getHolder()->getBirthDate();
            }
            // phone
            if (!is_null($requests->getHolder()->getPhone())) {
                $data = array_merge($data, self::holderPhone($requests, $properties));
            }
            // documents
            if (!is_null($requests->getHolder()->getDocuments())) {
                $data = array_merge($data, self::holderDocument($requests, $properties));
            }
        }
        return $data;
    }

    /**
     * @param  $request
     * @param  $properties
     * @return array
     */
    private static function holderPhone($request, $properties)
    {
        $data = [];
        if (!is_null($request->getHolder()->getPhone()->getAreaCode())) {
            $data[$properties::CREDIT_CARD_HOLDER_AREA_CODE] = $request->getHolder()->getPhone()->getAreaCode();
        }
        if (!is_null($request->getHolder()->getPhone()->getNumber())) {
            $data[$properties::CREDIT_CARD_HOLDER_PHONE] = $request->getHolder()->getPhone()->getNumber();
        }
        return $data;
    }

    /**
     * @param  $payment
     * @param  $properties
     * @return array
     */
    private static function holderDocument($payment, $properties)
    {
        $data = [];
        $document = $payment->getHolder()->getDocuments();

        if (!is_null($document)) {
            $data[$properties::CREDIT_CARD_HOLDER_CPF] = Characters::hasSpecialChars($document->getIdentifier());
        }

        return $data;
    }
}
