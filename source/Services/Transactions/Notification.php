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

namespace PagSeguro\Services\Transactions;

use Exception;
use PagSeguro\Resources\Connection\Data;
use PagSeguro\Configuration\Configure;
use PagSeguro\Parsers\Transaction\Notification\Request;
use PagSeguro\Domains\Account\Credentials;
use PagSeguro\Resources\Http;
use PagSeguro\Resources\Log\Logger;
use PagSeguro\Resources\Responsibility;

/**
 * Class Notifications
 *
 * @package PagSeguro\Services\Transactions
 */
class Notification
{
    /**
     * @return mixed
     * @throws Exception
     */
    public static function check(Credentials $credentials)
    {
        Logger::info("Begin", ['service' => 'Transactions.Notification']);
        try {
            $data = new Data($credentials);
            $http = new Http();
            Logger::info(sprintf("GET: %s", self::request($data)), ['service' => 'Transactions.Notification']);
            $http->get(
                self::request($data),
                20,
                Configure::getCharset()->getEncoding()
            );

            $response = Responsibility::http(
                $http,
                new Request()
            );
            Logger::info(
                sprintf(
                    "Date: %s, Code: %s",
                    $response->getDate(),
                    $response->getCode()
                ),
                ['service' => 'Transactions.Notification']
            );
            return $response;
        } catch (Exception $exception) {
            Logger::error($exception->getMessage(), ['service' => 'Transactions.Notification']);
            throw $exception;
        }
    }

    /**
     * @return string
     */
    private static function request(Data $data)
    {
        return $data->buildNotificationTransactionRequestUrl() . "/" .
        Responsibility::notifications() . "?" . $data->buildCredentialsQuery();
    }
}
