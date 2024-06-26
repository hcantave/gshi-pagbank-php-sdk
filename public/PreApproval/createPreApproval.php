<?php

use PagSeguro\Library;
use PagSeguro\Domains\Requests\PreApproval;
use PagSeguro\Enum\Shipping\Type;
use PagSeguro\Configuration\Configure;

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

$preApproval = new PreApproval();

// Set the currency
$preApproval->setCurrency("BRL");

// Set a reference code for this payment request. It is useful to identify this payment
// in future notifications.
$preApproval->setReference("REF123");

// Set shipping information for this payment request
$preApproval->setShipping()->setType(Type::SEDEX);
$preApproval->setShipping()->setAddress()->withParameters(
    '01452002',
    'Av. Brig. Faria Lima',
    '1384',
    'apto. 114',
    'Jardim Paulistano',
    'São Paulo',
    'SP',
    'BRA'
);

// Set your customer information.
$preApproval->setSender()->setName('João Comprador');
$preApproval->setSender()->setEmail('email@comprador.com.br');
$preApproval->setSender()->setPhone()->withParameters(
    11,
    56273440
);

$preApproval->setSender()->setAddress()->withParameters(
    '01452002',
    'Av. Brig. Faria Lima',
    '1384',
    'apto. 114',
    'Jardim Paulistano',
    'São Paulo',
    'SP',
    'BRA'
);

/***
 * Pre Approval information
 */
$preApproval->setPreApproval()->setCharge('manual');
$preApproval->setPreApproval()->setName("Seguro contra roubo do Notebook Prata");
$preApproval->setPreApproval()->setDetails(
    "Todo dia 30 será cobrado o valor de R100,00 referente ao seguro contra
            roubo do Notebook Prata."
);
$preApproval->setPreApproval()->setAmountPerPayment('100.00');
$preApproval->setPreApproval()->setMaxAmountPerPeriod('200.00');
$preApproval->setPreApproval()->setPeriod('Monthly');
$preApproval->setPreApproval()->setMaxTotalAmount('2400.00');
$preApproval->setPreApproval()->setInitialDate('2016-05-12T00:00:00');
$preApproval->setPreApproval()->setFinalDate('2018-05-07T00:00:00');

$preApproval->setRedirectUrl("http://www.lojateste.com.br/redirect");
$preApproval->setReviewUrl("http://www.lojateste.com.br/review");

try {

    /**
     * @todo For checkout with application use:
     * \PagSeguro\Configuration\Configure::getApplicationCredentials()
     *  ->setAuthorizationCode("FD3AF1B214EC40F0B0A6745D041BF50D")
     */
    $response = $preApproval->register(
        Configure::getAccountCredentials()
    );

    echo "<h2>Criando requisi&ccedil;&atilde;o de assinatura</h2>"
        . "<p>URL da assinatura: <strong>$response</strong></p>"
        . "<p><a title=\"URL da assinatura\" href=\"$response\" target=\_blank\">Ir para URL da assinatura.</a></p>";
} catch (Exception $e) {
    die($e->getMessage());
}
