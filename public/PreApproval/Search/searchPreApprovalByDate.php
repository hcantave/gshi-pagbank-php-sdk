<?php

use PagSeguro\Library;
use PagSeguro\Services\PreApproval\Search\Date;
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

require_once __DIR__ . "/../../../vendor/autoload.php";

Library::initialize();

$options = [
    'initial_date' => '2016-05-01T14:55',
    'final_date' => '2016-05-10T09:55', //Optional
    'page' => 1, //Optional
    'max_per_page' => 20, //Optional
];

try {
    $response = Date::search(
        Configure::getAccountCredentials(),
        $options
    );

    echo "<pre>";
    print_r($response);
} catch (Exception $e) {
    die($e->getMessage());
}
