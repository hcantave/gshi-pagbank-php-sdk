<?php
use PagSeguro\Library;
use PagSeguro\Domains\Requests\Authorization;
use PagSeguro\Enum\Authorization\Permissions;
use PagSeguro\Domains\Authorization\Personal;
use PagSeguro\Domains\Document;
use PagSeguro\Domains\Phone;
use PagSeguro\Enum\Authorization\PhoneEnum;
use PagSeguro\Domains\Address;
use PagSeguro\Domains\Authorization\Account;
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
 *
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

$person = new Personal(
    'John Doe',
    new DateTime('10-10-1990'),
    new Document('CPF', '00000000000'),
    new Phone('00', '000000000', PhoneEnum::MOBILE),
    new Address('Rua Um',
        '1',
        'Sem complemento',
        'Bairro',
        '00000000',
        'Cidade',
        'UF',
        'BRA'));

/**
 * Com o método a seguir é possível especificar outros telefones
 *
 * Os tipos de telefone permitidos são HOME, MOBILE e BUSINESS.
 */
$person->addPhones(new Phone('00', '000000000', PhoneEnum::BUSINESS));
$person->addPhones(new Phone('00', '000000000', PhoneEnum::BUSINESS));

$account = new Account('john@doe.com', $person);

$authorization->setAccount($account);

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
