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

namespace PagSeguro\Resources\Factory\Request\DirectPayment\CreditCard\Holder;

use PagSeguro\Enum\Properties\Current;

/**
 * Class Document
 *
 * @package PagSeguro\Resources\Factory
 */
class Phone
{
    /**
     * Phone constructor.
     *
     * @param $holder * @param Holder $holder
     */
    public function __construct(private $holder)
    {
    }

    /**
     * @param \PagSeguro\Domains\Phone $phone * @return Holder
     */
    public function instance(\PagSeguro\Domains\Phone $phone)
    {
        $this->holder->setPhone($phone);
        return $this->holder;
    }

    /**
     * @param $array * @return Holder
     */
    public function withArray($array)
    {
        $current = new Current();
        $phone = new \PagSeguro\Domains\Phone();
        $phone->setAreaCode($array[$current::SENDER_PHONE_AREA_CODE])
            ->setNumber($array[$current::SENDER_PHONE_NUMBER]);
        $this->holder->setPhone($phone);
        return $this->holder;
    }


    /**
     * @param $areaCode
     * @param $number   * @return Holder
     */
    public function withParameters($areaCode, $number)
    {
        $phone = new \PagSeguro\Domains\Phone();
        $phone->setAreaCode($areaCode)
            ->setNumber($number);
        $this->holder->setPhone($phone);
        return $this->holder;
    }
}
