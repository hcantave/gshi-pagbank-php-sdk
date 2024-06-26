<?php

use PagSeguro\Library;
use PagSeguro\Domains\Requests\DirectPreApproval\Plan;
use PagSeguro\Domains\AccountCredentials;

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

require_once __DIR__ . "/../../vendor/autoload.php";

Library::initialize();
Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");
/**
 *  Para usa o ambiente de testes (sandbox) descomentar a linha abaixo
 */
//\PagSeguro\Configuration\Configure::setEnvironment('sandbox');

$plan = new Plan();
$plan->setRedirectURL('http://meusite.com');
$plan->setReference('http://meusite.com');
$plan->setPreApproval()->setName('Plano XXXX');
$plan->setPreApproval()->setCharge('AUTO');
$plan->setPreApproval()->setPeriod('MONTHLY');
$plan->setPreApproval()->setAmountPerPayment('100.00');
$plan->setPreApproval()->setTrialPeriodDuration(28);
$plan->setPreApproval()->setDetails('detalhes do plano');
$plan->setPreApproval()->setFinalDate('2018-09-03');
$plan->setPreApproval()->setCancelURL("http://meusite.com");
$plan->setReviewURL('http://meusite.com./review');
$plan->setMaxUses(100);
$plan->setReceiver()->withParameters('exemplo@sandbox');

try {
    $response = $plan->register(
        new AccountCredentials('email vendedor', 'token vendedor') // credencias do vendedor no pagseguro
    );

    echo '<pre>';
    print_r($response);
} catch (Exception $e) {
    die($e->getMessage());
}
