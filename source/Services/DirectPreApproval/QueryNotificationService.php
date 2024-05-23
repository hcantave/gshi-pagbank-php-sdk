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
use PagSeguro\Domains\Requests\DirectPreApproval\QueryNotification;
use PagSeguro\Parsers\DirectPreApproval\QueryNotificationParser;
use PagSeguro\Resources\Http;
use PagSeguro\Resources\Log\Logger;
use PagSeguro\Resources\Responsibility;

/**
 * Class QueryNotificationService
 *
 * @package PagSeguro\Services\DirectPreApproval
 */
class QueryNotificationService
{
    /**
     * @return mixed
     * @throws Exception
     */
    public static function create(Credentials $credentials, QueryNotification $queryNotification)
    {
        Logger::info("Begin", ['service' => 'DirectPreApproval']);
        try {
            $data = new Data($credentials);
            $http = new Http('Content-Type: application/json;', 'Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1');
            Logger::info(
                sprintf(
                    "GET: %s",
                    self::request(
                        $data,
                        QueryNotificationParser::getData($queryNotification),
                        QueryNotificationParser::getNotificationCode($queryNotification)
                    )
                ),
                ['service' => 'DirectPreApproval']
            );
            Logger::info(
                sprintf(
                    "Params: %s",
                    json_encode(QueryNotificationParser::getData($queryNotification))
                ),
                ['service' => 'DirectPreApproval']
            );
            $http->get(
                self::request(
                    $data,
                    QueryNotificationParser::getData($queryNotification),
                    QueryNotificationParser::getNotificationCode($queryNotification)
                ),
                20,
                Configure::getCharset()->getEncoding()
            );
            $response = Responsibility::http(
                $http,
                new QueryNotificationParser()
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
     * @param null            $params
     * @param null            $preApprovalCode
     * @return string
     */
    private static function request(Data $data, $params = null, $preApprovalCode = null)
    {
        return $data->buildDirectPreApprovalQueryNotificationRequestUrl($preApprovalCode) . "?" . $data->buildCredentialsQuery() . ($params ? '&' . $params : '');
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
