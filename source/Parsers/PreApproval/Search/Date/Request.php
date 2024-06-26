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

namespace PagSeguro\Parsers\PreApproval\Search\Date;

use PagSeguro\Parsers\Error;
use PagSeguro\Parsers\Parser;
use PagSeguro\Parsers\PreApproval\Search\Result;
use PagSeguro\Resources\Http;

/**
 * Class Request
 *
 * @package PagSeguro\Parsers\PreApproval\Search\Date
 */
class Request extends Error implements Parser
{
    /**
     *
     *
     * @return Response
     */
    public static function success(Http $http)
    {
        $xml = simplexml_load_string($http->getResponse());
        $result = new Result();
        $result->setDate(current($xml->date))
            ->setPreApprovals(current($xml->preApprovals))
            ->setResultsInThisPage(current($xml->resultsInThisPage))
            ->setCurrentPage(current($xml->currentPage))
            ->setTotalPages(current($xml->totalPages));
        return $result;
    }

    /**
     *
     *
     * @return \PagSeguro\Domains\Error
     */
    public static function error(Http $http)
    {
        return parent::error($http);
    }
}
