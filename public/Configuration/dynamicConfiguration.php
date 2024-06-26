<?php

use PagSeguro\Library;
use PagSeguro\Configuration\Configure;
use PagSeguro\Services\Session;

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

/*
 * To do a dynamic configuration of the library credentials you have to use the set methods
 * from the static class \PagSeguro\Configuration\Configure.
 */

//For example, to configure the library dynamically:
Configure::setEnvironment('sandbox');//production or sandbox
Configure::setAccountCredentials(
    'info@gshi.ca',
    '$WOlmQR3026@p/keF539'
);
Configure::setCharset('UTF-8');// UTF-8 or ISO-8859-1
Configure::setLog(true, '/logpath/logFilename.log');

/**
 * @todo To set the application credentials instead of the account credentials use:
 * \PagSeguro\Configuration\Configure::setApplicationCredentials(
 *  'appId',
 *  'appKey'
 * );
 */

try {
    /**
     * @todo For use with application credentials use:
     * \PagSeguro\Configuration\Configure::getApplicationCredentials()
     *  ->setAuthorizationCode("FD3AF1B214EC40F0B0A6745D041BFDDD")
     */
    $sessionCode = Session::create(
        Configure::getAccountCredentials()
    );

    echo "<strong>ID de sess&atilde;o criado: </strong>{$sessionCode->getResult()}";
} catch (Exception $e) {
    die($e->getMessage());
}
