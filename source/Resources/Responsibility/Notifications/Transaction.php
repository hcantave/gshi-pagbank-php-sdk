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

namespace PagSeguro\Resources\Responsibility\Notifications;

use PagSeguro\Enum\Notification;
use PagSeguro\Helpers\NotificationObject;
use PagSeguro\Helpers\Xhr;

/**
 * Class Transaction
 *
 * @package PagSeguro\Resources\Responsibility\Notifications
 */
class Transaction implements Handler
{
    /**
     * @var
     */
    private $successor;

    /**
     * @param  $next
     * @return $this
     */
    public function successor($next)
    {
        $this->successor = $next;
        return $this;
    }

    /**
     * @return mixed
     */
    public function handler()
    {
        if (
            !is_null(Xhr::getInputCode()) && !is_null(Xhr::getInputType()) && Xhr::getInputType() == Notification::TRANSACTION
        ) {
            $notification = NotificationObject::initialize();
            return $notification->getCode();
        }
        return $this->successor->handler();
    }
}
