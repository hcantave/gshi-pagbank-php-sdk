<?php

use PagSeguro\Library;
use PagSeguro\Services\Installment;
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

require_once __DIR__ . "/../vendor/autoload.php";

Library::initialize();
Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

$options = [
    'amount' => 30.00, //Required
    'card_brand' => 'visa', //Optional
    'max_installment_no_interest' => 2 //Optional
];

try {
    $result = Installment::create(
        Configure::getAccountCredentials(),
        $options
    );

    echo "<pre>";
    print_r($result->getInstallments());
} catch (Exception $e) {
    die($e->getMessage());
}
