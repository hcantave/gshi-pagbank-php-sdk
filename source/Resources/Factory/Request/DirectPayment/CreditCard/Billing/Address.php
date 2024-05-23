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

namespace PagSeguro\Resources\Factory\Request\DirectPayment\CreditCard\Billing;

use PagSeguro\Enum\Properties\Current;

/**
 * Class Shipping
 *
 * @package PagSeguro\Resources\Factory\Request
 */
class Address
{
    /**
     * Shipping constructor.
     *
     * @param $billing * @param Billing $billing
     */
    public function __construct(private $billing)
    {
    }

    /**
     * @param \PagSeguro\Domains\Address $address * @return Billing
     */
    public function instance(\PagSeguro\Domains\Address $address)
    {
        $this->billing->setAddress($address);
        return $this->billing;
    }

    /**
     * @param $array * @return Billing
     */
    public function withArray($array)
    {
        $current = new Current();
        $address = new \PagSeguro\Domains\Address();
        $address->setPostalCode($array[$current::SHIPPING_ADDRESS_POSTAL_CODE])
            ->setStreet($array[$current::SHIPPING_ADDRESS_STREET])
            ->setNumber($array[$current::SHIPPING_ADDRESS_NUMBER])
            ->setComplement($array[$current::SHIPPING_ADDRESS_COMPLEMENT])
            ->setDistrict($array[$current::SHIPPING_ADDRESS_DISTRICT])
            ->setCity($array[$current::SHIPPING_ADDRESS_NUMBER])
            ->setState($array[$current::SHIPPING_ADDRESS_STATE])
            ->setCountry($array[$current::SHIPPING_ADDRESS_COUNTRY]);
        $this->billing->setAddress($address);
        return $this->billing;
    }

    /**
     * @param $street
     * @param $number
     * @param null $complement
     * @param $district
     * @param $postalCode
     * @param $city
     * @param $state
     * @param $country    * @return Billing
     */
    public function withParameters(
        $street,
        $number,
        $district,
        $postalCode,
        $city,
        $state,
        $country,
        $complement = null
    ) {
        $address = new \PagSeguro\Domains\Address();
        $address->setPostalCode($postalCode)
            ->setStreet($street)
            ->setNumber($number)
            ->setComplement($complement)
            ->setDistrict($district)
            ->setCity($city)
            ->setState($state)
            ->setCountry($country);
        $this->billing->setAddress($address);
        return $this->billing;
    }
}
