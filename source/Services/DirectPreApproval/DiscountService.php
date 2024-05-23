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

namespace PagSeguro\Services\DirectPreApproval;

use Exception;
use PagSeguro\Resources\Connection\Data;
use PagSeguro\Configuration\Configure;
use PagSeguro\Domains\Account\Credentials;
use PagSeguro\Domains\Requests\DirectPreApproval\Discount;
use PagSeguro\Parsers\DirectPreApproval\DiscountParser;
use PagSeguro\Resources\Connection;
use PagSeguro\Resources\Http;
use PagSeguro\Resources\Log\Logger;
use PagSeguro\Resources\Responsibility;

/**
 * Class DiscountService
 *
 * @package PagSeguro\Services\DirectPreApproval
 */
class DiscountService
{
    /**
     * @param Credentials $credentials
     * @param Discount    $discount
     *
     * @return mixed
     * @throws Exception
     */
    public static function create(Credentials $credentials, Discount $discount)
    {
        Logger::info("Begin", ['service' => 'DirectPreApproval']);
        try {
            $connection = new Data($credentials);
            $http = new Http('Content-Type: application/json;', 'Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1');
            Logger::info(
                sprintf("PUT: %s", self::request($connection, DiscountParser::getPreApprovalCode($discount))),
                ['service' => 'DirectPreApproval']
            );
            Logger::info(
                sprintf(
                    "Params: %s",
                    json_encode(DiscountParser::getData($discount))
                ),
                ['service' => 'DirectPreApproval']
            );
            $http->put(
                self::request($connection, DiscountParser::getPreApprovalCode($discount)),
                DiscountParser::getData($discount),
                20,
                Configure::getCharset()->getEncoding()
            );
            $response = Responsibility::http(
                $http,
                new DiscountParser
            );
            Logger::info(
                sprintf("DirectPreApproval URL: %s", json_encode(self::response($response))),
                ['service' => 'DirectPreApproval']
            );

            return self::response($response);
        } catch (Exception $exception) {
            Logger::error($exception->getMessage(), ['service' => 'DirectPreApproval']);
            throw $exception;
        }
    }

    /**
     * @param Connection\Data $connection
     * @param $preApprovalCode
     *
     * @return string
     */
    private static function request(Data $connection, $preApprovalCode)
    {
        return $connection->buildDirectPreApprovalDiscountRequestUrl($preApprovalCode) . "?" . $connection->buildCredentialsQuery();
    }

    /**
     * @param $response
     *
     * @return mixed
     */
    private static function response($response)
    {
        return $response;
    }
}
