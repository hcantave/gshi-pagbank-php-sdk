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
use PagSeguro\Domains\Requests\DirectPreApproval\EditPlan;
use PagSeguro\Parsers\DirectPreApproval\EditPlanParser;
use PagSeguro\Resources\Http;
use PagSeguro\Resources\Log\Logger;
use PagSeguro\Resources\Responsibility;

/**
 * Class EditPlanService
 *
 * @package PagSeguro\Services\DirectPreApproval
 */
class EditPlanService
{
    /**
     * @return mixed
     * @throws Exception
     */
    public static function edit(Credentials $credentials, EditPlan $editPlan)
    {
        Logger::info("Begin", ['service' => 'DirectPreApproval']);
        try {
            $data = new Data($credentials);
            $http = new Http('Content-Type: application/json;', 'Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1');

            Logger::info(
                sprintf(
                    "PUT: %s",
                    self::request($data, EditPlanParser::getPreApprovalRequestCode($editPlan))
                ),
                ['service' => 'DirectPreApproval']
            );
            Logger::info(
                sprintf(
                    "Params: %s",
                    json_encode(EditPlanParser::getData($editPlan))
                ),
                ['service' => 'DirectPreApproval']
            );

            $http->put(
                self::request($data, EditPlanParser::getPreApprovalRequestCode($editPlan)),
                EditPlanParser::getData($editPlan),
                20,
                Configure::getCharset()->getEncoding()
            );

            $response = Responsibility::http(
                $http,
                new EditPlanParser()
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
     * @param $preApprovalCode
     * @return string
     */
    private static function request(Data $data, $preApprovalCode)
    {
        return $data->buildDirectPreApprovalEditPlanRequestUrl($preApprovalCode) . "?" . $data->buildCredentialsQuery();
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
