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

namespace PagSeguro\Domains\DirectPreApproval;

/**
 * Class PaymentMethod
 *
 * @package PagSeguro\Domains\DirectPreApproval
 */
class PaymentMethod
{
    /**
     * @var string
     */
    public $type = 'CREDITCARD';
    /**
     * @var CreditCard
     */
    public $creditCard;

    /**
     * PaymentMethod constructor.
     */
    public function __construct()
    {
        $this->creditCard = new CreditCard();
    }

    /**
     * @return CreditCard
     */
    public function setCreditCard()
    {
        return $this->creditCard;
    }
}
