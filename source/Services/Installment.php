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

namespace PagSeguro\Services;

use Exception;
use PagSeguro\Resources\Connection\Data;
use PagSeguro\Configuration\Configure;
use PagSeguro\Domains\Account\Credentials;
use PagSeguro\Enum\Properties\Current;
use PagSeguro\Helpers\Currency;
use PagSeguro\Parsers\Installment\Request;
use PagSeguro\Resources\Http;
use PagSeguro\Resources\Log\Logger;
use PagSeguro\Resources\Responsibility;

/**
 * Description of Installment
 */
class Installment
{
    /**
     * @param Credentials $credentials * @return Installments
     */
    public static function create(Credentials $credentials, mixed $params)
    {
        Logger::info("Begin", ['service' => 'Installment']);
        try {
            $data = new Data($credentials);
            $http = new Http();
            Logger::info(sprintf("GET: %s", self::request($data, $params)), ['service' => 'Installment']);
            $http->get(
                self::request($data, $params),
                20,
                Configure::getCharset()->getEncoding()
            );

            return Responsibility::http(
                $http,
                new Request()
            );
        } catch (Exception $exception) {
            Logger::error($exception->getMessage(), ['service' => 'Installment']);
            throw $exception;
        }
    }

    /**
     * Build the service request url
     *
     * @return string
     */
    private static function request(Data $data, mixed $params)
    {
        return sprintf(
            "%s?%s%s%s%s",
            $data->buildInstallmentRequestUrl(),
            $data->buildCredentialsQuery(),
            sprintf(
                "&%s=%s",
                Current::INSTALLMENT_AMOUNT,
                Currency::toDecimal($params['amount'])
            ),
            !isset($params['card_brand']) || is_null($params['card_brand']) ? '' :
                sprintf("&%s=%s", Current::INSTALLMENT_CARD_BRAND, $params['card_brand']),
            !isset($params['max_installment_no_interest']) || is_null($params['max_installment_no_interest']) ? '' :
                sprintf(
                    "&%s=%s",
                    Current::INSTALLMENT_MAX_INSTALLMENT_NO_INTEREST,
                    $params['max_installment_no_interest']
                )
        );
    }
}
