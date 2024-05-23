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

/**
 * Trait PreApproval
 *
 * @package PagSeguro\Parsers
 */
trait PreApproval
{
    /**
     * @param  $properties
     * @return array
     */
    public static function getData(Requests $requests, $properties)
    {
        $data = [];
        if (!is_null($requests->getPreApproval())) {
            if (!is_null($requests->getPreApproval()->getCharge())) {
                $data[$properties::PRE_APPROVAL_CHARGE] = $requests->getPreApproval()->getCharge();
            }
            if (!is_null($requests->getPreApproval()->getName())) {
                $data[$properties::PRE_APPROVAL_NAME] = $requests->getPreApproval()->getName();
            }
            if (!is_null($requests->getPreApproval()->getDetails())) {
                $data[$properties::PRE_APPROVAL_DETAILS] =
                    $requests->getPreApproval()->getDetails();
            }
            if (!is_null($requests->getPreApproval()->getAmountPerPayment())) {
                $data[$properties::PRE_APPROVAL_AMOUNT_PER_PAYMENT] =
                    $requests->getPreApproval()->getAmountPerPayment();
            }
            if (!is_null($requests->getPreApproval()->getMaxAmountPerPayment())) {
                $data[$properties::PRE_APPROVAL_MAX_AMOUNT_PER_PAYMENT] =
                    $requests->getPreApproval()->getMaxAmountPerPayment();
            }
            if (!is_null($requests->getPreApproval()->getPeriod())) {
                $data[$properties::PRE_APPROVAL_PERIOD] = $requests->getPreApproval()->getPeriod();
            }
            if (!is_null($requests->getPreApproval()->getMaxPaymentsPerPeriod())) {
                $data[$properties::PRE_APPROVAL_MAX_PAYMENTS_PER_PERIOD] =
                    $requests->getPreApproval()->getMaxPaymentsPerPeriod();
            }
            if (!is_null($requests->getPreApproval()->getMaxAmountPerPeriod())) {
                $data[$properties::PRE_APPROVAL_MAX_AMOUNT_PER_PERIOD] =
                    $requests->getPreApproval()->getMaxAmountPerPeriod();
            }
            if (!is_null($requests->getPreApproval()->getInitialDate())) {
                $data[$properties::PRE_APPROVAL_INITIAL_DATE] =
                    $requests->getPreApproval()->getInitialDate();
            }
            if (!is_null($requests->getPreApproval()->getFinalDate())) {
                $data[$properties::PRE_APPROVAL_FINAL_DATE] =
                    $requests->getPreApproval()->getFinalDate();
            }
            if (!is_null($requests->getPreApproval()->getMaxTotalAmount())) {
                $data[$properties::PRE_APPROVAL_MAX_TOTAL_AMOUNT] =
                    $requests->getPreApproval()->getMaxTotalAmount();
            }
        }
        return $data;
    }
}
