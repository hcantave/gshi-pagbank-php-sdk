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

namespace PagSeguro\Resources\Factory;

use PagSeguro\Enum\Properties\Current;

/**
 * Class Shipping
 *
 * @package PagSeguro\Resources\Factory\Request
 */
class Item
{
    /**
     * @var array
     */
    private $item = [];

    /**
     * @return \PagSeguro\Domains\Item
     */
    public function instance(\PagSeguro\Domains\Item $item)
    {
        return $item;
    }

    /**
     * @param  $array
     * @return array
     */
    public function withArray($array)
    {
        $current = new Current();

        $item = new \PagSeguro\Domains\Item();
        $item->setId($array[$current::ITEM_ID])
            ->setAmount($array[$current::ITEM_AMOUNT])
            ->setDescription($array[$current::ITEM_DESCRIPTION])
            ->setQuantity($array[$current::ITEM_QUANTITY])
            ->setWeight($array[$current::ITEM_WEIGHT])
            ->setShippingCost($array[$current::ITEM_SHIPPING_COST]);

        $this->item[] = $item;
        return $this->item;
    }

    /**
     * @param  $id
     * @param  $description
     * @param  $quantity
     * @param  $amount
     * @param  null $weight
     * @param  null $shippingCost
     * @return array
     */
    public function withParameters(
        $id,
        $description,
        $quantity,
        $amount,
        $weight = null,
        $shippingCost = null
    ) {
        $item = new \PagSeguro\Domains\Item();
        $item->setId($id)
            ->setAmount($amount)
            ->setDescription($description)
            ->setQuantity($quantity)
            ->setWeight($weight)
            ->setShippingCost($shippingCost);
        $this->item[] = $item;
        return $this->item;
    }
}
