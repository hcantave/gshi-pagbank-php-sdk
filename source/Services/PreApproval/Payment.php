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

namespace PagSeguro\Services\PreApproval;

use PagSeguro\Resources\Connection\Data;
use PagSeguro\Configuration\Configure;
use Exception;
use PagSeguro\Domains\Account\Credentials;
use PagSeguro\Domains\Requests\PreApproval;
use PagSeguro\Helpers\Crypto;
use PagSeguro\Parsers\PreApproval\Request;
use PagSeguro\Resources\Http;
use PagSeguro\Resources\Log\Logger;
use PagSeguro\Resources\Responsibility;

class Payment
{
    public static function create(Credentials $credentials, PreApproval $preApproval)
    {
        Logger::info("Begin", ['service' => 'PreApproval']);
        try {
            $data = new Data($credentials);
            $http = new Http();
            Logger::info(sprintf("POST: %s", self::request($data)), ['service' => 'PreApproval']);
            Logger::info(
                sprintf(
                    "Params: %s",
                    json_encode(Crypto::encrypt(Request::getData($preApproval)))
                ),
                ['service' => 'PreApproval']
            );

            $http->post(
                self::request($data),
                Request::getData($preApproval),
                20,
                Configure::getCharset()->getEncoding()
            );

            $response = Responsibility::http(
                $http,
                new Request()
            );
            Logger::info(
                sprintf("PreApproval URL: %s", self::response($data, $response)),
                ['service' => 'PreApproval']
            );
            return self::response($data, $response);
        } catch (Exception $exception) {
            Logger::error($exception->getMessage(), ['service' => 'PreApproval']);
            throw $exception;
        }
    }

    /**
     * @return string
     */
    private static function request(Data $data)
    {
        return $data->buildPreApprovalRequestUrl() . "?" . $data->buildCredentialsQuery();
    }

    /**
     * @param  $response
     * @return string
     */
    private static function response(Data $data, $response)
    {
        return $data->buildPreApprovalResponseUrl() . "?code=" . $response->getCode();
    }
}
