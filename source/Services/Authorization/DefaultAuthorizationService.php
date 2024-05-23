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

namespace PagSeguro\Services\Authorization;

use DOMDocument;
use DOMNode;
use PagSeguro\Domains\Authorization;

/**
 * Class CompanySeller
 *
 * @package PagSeguro\Services\Authorization
 */
class DefaultAuthorizationService
{
    /**
     *
     *
     * @var DOMDocument
     */
    private $domDocument;

    /**
     * Seller constructor.
     */
    public function __construct(private Authorization $authorization)
    {
        $this->domDocument = new DOMDocument('1.0', 'UTF-8');
        $this->domDocument->xmlStandalone = true;
        $this->makeAuthorizationNode();
    }

    /**
     *
     *
     * @return DOMNode
     */
    private function makeAuthorizationNode()
    {
        $authorizationRequestElement = $this->domDocument->createElement('authorizationRequest');
        $authorizationRequestDom = $this->domDocument->appendChild($authorizationRequestElement);

        $referenceElement = $this->domDocument->createElement('reference', $this->authorization->getReference());
        $authorizationRequestDom->appendChild($referenceElement);

        $permissionsElement = $this->domDocument->createElement('permissions');
        $permissionsDom = $authorizationRequestDom->appendChild($permissionsElement);

        $permissions = $this->authorization->getPermissions();
        $permissions = explode(',', $permissions);

        foreach ($permissions as $permission) {
            $codeElement = $this->domDocument->createElement('code', $permission);
            $permissionsDom->appendChild($codeElement);
        }
        $redirectURLElement = $this->domDocument->createElement('redirectURL', $this->authorization->getRedirectURL());
        $authorizationRequestDom->appendChild($redirectURLElement);

        $notificationURLElement = $this->domDocument->createElement(
            'notificationURL',
            $this->authorization->getNotificationURL()
        );
        $authorizationRequestDom->appendChild($notificationURLElement);

        return $authorizationRequestDom;
    }

    /**
     * @return string
     */
    public function getAsXML()
    {
        return $this->domDocument->saveXML();
    }
}
