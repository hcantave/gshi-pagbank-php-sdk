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
 *
 */

namespace PagSeguro\Resources\Connection;

use PagSeguro\Resources\Connection\Base\Application\Authorization;
use PagSeguro\Resources\Connection\Base\Application\Authorization\Search;
use PagSeguro\Resources\Connection\Base\Checkout\Payment;
use PagSeguro\Resources\Connection\Base\Installment;
use PagSeguro\Resources\Connection\Base\Notification;
use PagSeguro\Resources\Connection\Base\PreApproval\Cancel;
use PagSeguro\Resources\Connection\Base\PreApproval\Charge;
use PagSeguro\Resources\Connection\Base\Refund;
use PagSeguro\Resources\Connection\Base\Session;
use PagSeguro\Resources\Connection\Base\Transaction\Abandoned;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\Accession;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\Plan;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\EditPlan;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\Query;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\Status;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\Discount;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\ChangePayment;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\QueryPaymentOrder;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\QueryNotification;
use PagSeguro\Resources\Connection\Base\DirectPreApproval\RetryPaymentOrder;
use PagSeguro\Domains\Account\Credentials;

/**
 * Class Data
 * @package PagSeguro\Services\Connection
 */
class Data
{
    use Authorization;
    use Search {
        Search::buildSearchRequestUrl as buildAuthorizationSearchRequestUrl;
        Search::buildSearchRequestUrl insteadof Base\Transaction\Search;
    }
    use Payment;
    use Base\Credentials;
    use Base\DirectPayment\Payment;
    use Installment;
    use Notification;
    use Cancel;
    use Charge;
    use Base\PreApproval\Payment;
    use Base\PreApproval\Search {
        Base\PreApproval\Search::buildSearchRequestUrl as buildPreApprovalSearchRequestUrl;
        Base\PreApproval\Search::buildSearchRequestUrl insteadof Search;
    }
    use Refund;
    use Session;
    use Abandoned;
    use Base\Transaction\Cancel;
    use Base\Transaction\Search {
        Base\Transaction\Search::buildSearchRequestUrl as buildTransactionSearchRequestUrl;
        Base\Transaction\Search::buildSearchRequestUrl insteadof Base\PreApproval\Search;
    }
    use Accession;
    use Plan;
    use EditPlan;
    use Query;
    use Base\DirectPreApproval\Payment;
    use Status;
    use Base\DirectPreApproval\Cancel;
    use Discount;
    use ChangePayment;
    use QueryPaymentOrder;
    use QueryNotification;
    use RetryPaymentOrder;

    /**
     * Data constructor.
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $this->setCredentials($credentials);
    }

    /**
     * @param $data
     * @return string
     */
    public function buildHttpUrl($data)
    {
        return http_build_query($data);
    }
}
