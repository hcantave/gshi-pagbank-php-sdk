<?php

use PagSeguro\Library;
use PagSeguro\Domains\Requests\Authorization;
use PagSeguro\Enum\Authorization\Permissions;
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

require_once "../../vendor/autoload.php";

try {
    Library::initialize();
} catch (Exception $e) {
    die($e);
}
Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

$authorization = new Authorization();

$authorization->setReference("AUTH_LIB_PHP_0001");
$authorization->setRedirectUrl("http://www.lojamodelo.com.br");
$authorization->setNotificationUrl("http://www.lojamodelo.com.br/nofitication");

$authorization->addPermission(Permissions::CREATE_CHECKOUTS);
$authorization->addPermission(Permissions::SEARCH_TRANSACTIONS);
$authorization->addPermission(Permissions::RECEIVE_TRANSACTION_NOTIFICATIONS);
$authorization->addPermission(Permissions::MANAGE_PAYMENT_PRE_APPROVALS);
$authorization->addPermission(Permissions::DIRECT_PAYMENT);

try {
    $response = $authorization->register(
        Configure::getApplicationCredentials()
    );
    echo "<h2>Criando requisi&ccedil;&atilde;o de authorização</h2>"
        . "<p>URL do pagamento: <strong>$response</strong></p>"
        . "<p><a title=\"URL de Autorização\" href=\"$response\" target=\_blank\">"
        . "Ir para URL de authorização.</a></p>";
} catch (Exception $e) {
    die($e->getMessage());
}
