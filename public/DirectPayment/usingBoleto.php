<?php

use PagSeguro\Library;
use PagSeguro\Domains\Requests\DirectPayment\Boleto;
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

//Instantiate a new Boleto Object
$boleto = new Boleto();

// Set the Payment Mode for this payment request
$boleto->setMode('DEFAULT');

/**
 * @todo Change the receiver Email
 */
//$boleto->setReceiverEmail('vendedor@lojamodelo.com.br');

// Set the currency
$boleto->setCurrency("BRL");

// Add an item for this payment request
$boleto->addItems()->withParameters(
    '0001',
    'Notebook prata',
    2,
    130.00
);

// Add an item for this payment request
$boleto->addItems()->withParameters(
    '0002',
    'Notebook preto',
    2,
    430.00
);

// Set a reference code for this payment request. It is useful to identify this payment
// in future notifications.
$boleto->setReference("LIBPHP000001-boleto");

//set extra amount
$boleto->setExtraAmount(11.5);

// Set your customer information.
// If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
$boleto->setSender()->setName('João Comprador');
$boleto->setSender()->setEmail('email@comprador.com.br');

$boleto->setSender()->setPhone()->withParameters(
    11,
    56273440
);

$boleto->setSender()->setDocument()->withParameters(
    'CPF',
    'insira um numero de CPF valido'
);

$boleto->setSender()->setHash('3dc25e8a7cb3fd3104e77ae5ad0e7df04621caa33e300b27aeeb9ea1adf1a24f');

$boleto->setSender()->setIp('127.0.0.0');

// Set shipping information for this payment request
$boleto->setShipping()->setAddress()->withParameters(
    'Av. Brig. Faria Lima',
    '1384',
    'Jardim Paulistano',
    '01452002',
    'São Paulo',
    'SP',
    'BRA',
    'apto. 114'
);

// If your payment request don't need shipping information use:
// $boleto->setShipping()->setAddressRequired()->withParameters('FALSE');

try {
    //Get the crendentials and register the boleto payment
    $result = $boleto->register(
        Configure::getAccountCredentials()
    );

    // You can use methods like getCode() to get the transaction code and getPaymentLink() for the Payment's URL.
    echo "<pre>";
    print_r($result);
} catch (Exception $e) {
    echo "</br> <strong>";
    die($e->getMessage());
}
