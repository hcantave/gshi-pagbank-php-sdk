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

namespace PagSeguro\Enum\Authorization;

use PagSeguro\Enum\Enum;

/**
 * Class Permissions
 *
 * @package PagSeguro\Enum\Authorization
 */
class Permissions extends Enum
{
    /**
     *
     */
    public const CREATE_CHECKOUTS = 'CREATE_CHECKOUTS';

    /**
     *
     */
    public const RECEIVE_TRANSACTION_NOTIFICATIONS = 'RECEIVE_TRANSACTION_NOTIFICATIONS';

    /**
     *
     */
    public const SEARCH_TRANSACTIONS = 'SEARCH_TRANSACTIONS';

    /**
     *
     */
    public const MANAGE_PAYMENT_PRE_APPROVALS = 'MANAGE_PAYMENT_PRE_APPROVALS';

    /**
     *
     */
    public const DIRECT_PAYMENT = 'DIRECT_PAYMENT';
}
