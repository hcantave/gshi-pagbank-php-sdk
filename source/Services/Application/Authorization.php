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

namespace PagSeguro\Services\Application;

use PagSeguro\Resources\Connection\Data;
use Exception;
use PagSeguro\Configuration\Configure;
use PagSeguro\Domains\Account\Credentials;
use PagSeguro\Parsers\Authorization\Request;
use PagSeguro\Resources\Http;
use PagSeguro\Resources\Log\Logger;
use PagSeguro\Resources\Responsibility;

class Authorization
{
    public static function create(Credentials $credentials, \PagSeguro\Domains\Requests\Authorization $authorization)
    {
        Logger::info("Begin", ['service' => 'Authorization']);
        try {
            $data = new Data($credentials);
            $http = new Http('Content-Type: application/xml;');
            Logger::info(sprintf("POST: %s", self::request($data)), ['service' => 'Authorization']);
            Logger::info(
                sprintf(
                    "Params: %s",
                    Request::getData($authorization)
                ),
                ['service' => 'Checkout']
            );
            $http->post(
                self::request($data),
                Request::getData($authorization),
                20,
                Configure::getCharset()->getEncoding()
            );

            $response = Responsibility::http($http, new Request());
            Logger::info(
                sprintf(
                    "Authorization URL: %s",
                    self::response($data, $response)
                ),
                ['service' => 'Authorization']
            );

            return self::response($data, $response);
        } catch (Exception $exception) {
            Logger::error($exception->getMessage(), ['service' => 'Authorization']);
            die($exception);
        }
    }

    /**
     * @return string
     */
    private static function request(Data $data)
    {
        return $data->buildAuthorizationRequestUrl() . "?" . $data->buildCredentialsQuery();
    }

    /**
     * @param $response
     * @return string
     */
    private static function response(Data $data, $response)
    {
        return $data->buildAuthorizationResponseUrl() . "?code=" . $response->getCode();
    }
}
