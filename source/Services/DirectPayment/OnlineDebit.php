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

namespace PagSeguro\Services\DirectPayment;

use Exception;
use PagSeguro\Resources\Connection\Data;
use PagSeguro\Configuration\Configure;
use PagSeguro\Domains\Account\Credentials;
use PagSeguro\Helpers\Crypto;
use PagSeguro\Parsers\DirectPayment\OnlineDebit\Request;
use PagSeguro\Resources\Http;
use PagSeguro\Resources\Log\Logger;
use PagSeguro\Resources\Responsibility;

/**
 * Class Payment
 *
 * @package PagSeguro\Services\DirectPayment
 */
class OnlineDebit
{
    /**
     *
     *
     * @return string
     * @throws Exception
     */
    public static function checkout(
        Credentials $credentials,
        \PagSeguro\Domains\Requests\DirectPayment\OnlineDebit $onlineDebit
    ) {
        Logger::info("Begin", ['service' => 'DirectPayment.OnlineDebit']);
        try {
            $data = new Data($credentials);
            $http = new Http();
            Logger::info(
                sprintf("POST: %s", self::request($data)),
                ['service' => 'DirectPayment.OnlineDebit']
            );
            Logger::info(
                sprintf(
                    "Params: %s",
                    json_encode(Crypto::encrypt(Request::getData($onlineDebit)))
                ),
                ['service' => 'Checkout']
            );
            $http->post(
                self::request($data),
                Request::getData($onlineDebit),
                20,
                Configure::getCharset()->getEncoding()
            );

            $response = Responsibility::http(
                $http,
                new Request()
            );

            Logger::info(
                sprintf("Online Debit Payment Link URL: %s", $response->getPaymentLink()),
                ['service' => 'DirectPayment.OnlineDebit']
            );

            return $response;
        } catch (Exception $exception) {
            Logger::error($exception->getMessage(), ['service' => 'DirectPayment.OnlineDebit']);
            throw $exception;
        }
    }

    /**
     * @return string
     */
    private static function request(Data $data)
    {
        return $data->buildDirectPaymentRequestUrl() . "?" . $data->buildCredentialsQuery();
    }
}
