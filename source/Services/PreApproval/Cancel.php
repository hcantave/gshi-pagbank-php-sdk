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

use Exception;
use PagSeguro\Resources\Connection\Data;
use PagSeguro\Configuration\Configure;
use PagSeguro\Domains\Account\Credentials;
use PagSeguro\Parsers\Cancel\Request;
use PagSeguro\Parsers\Cancel\Response;
use PagSeguro\Resources\Http;
use PagSeguro\Resources\Log\Logger;
use PagSeguro\Resources\Responsibility;

/**
 * Class Payment
 *
 * @package PagSeguro\Services\Checkout
 */
class Cancel
{
    /**
     * @param  $code
     * @return Response
     * @throws Exception
     */
    public static function create(Credentials $credentials, $code)
    {
        Logger::info("Begin", ['service' => 'PreApproval.Cancel']);
        try {
            $data = new Data($credentials);
            $http = new Http();
            Logger::info(sprintf("GET: %s", self::request($data, $code)), ['service' => 'PreApproval.Cancel']);
            Logger::info(
                sprintf("Params: %s", $code),
                ['service' => 'Cancel']
            );

            $http->get(
                self::request($data, $code),
                20,
                Configure::getCharset()->getEncoding()
            );

            $response = Responsibility::http(
                $http,
                new Request()
            );

            Logger::info(sprintf("Result: %s", current($response)), ['service' => 'PreApproval.Cancel']);
            return $response;
        } catch (Exception $exception) {
            Logger::error($exception->getMessage(), ['service' => 'PreApproval.Cancel']);
            throw $exception;
        }
    }

    /**
     * @param  $code
     * @return string
     */
    private static function request(Data $data, $code)
    {
        return sprintf(
            "%s/%s/?%s",
            $data->buildPreApprovalCancelUrl(),
            $code,
            $data->buildCredentialsQuery()
        );
    }
}
