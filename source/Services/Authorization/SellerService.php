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
use PagSeguro\Domains\Document;
use PagSeguro\Domains\Phone;

/**
 * Class BusinessService
 *
 * @package PagSeguro\Services\Authorization
 */
class SellerService
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
        $authorizationNode = $this->makeAuthorizationNode();
        $accountNode = $this->makeAccountNode($authorizationNode);
        $personNode = $this->makePersonNode($accountNode);
        $this->makePhonesNode($personNode);
        $this->makeDocumentsNode($personNode);
        $this->makeAddressNode($personNode);
    }

    /**
     *
     *
     * @return DOMNode
     */
    private function makeAuthorizationNode()
    {
        $domElement = $this->domDocument->createElement('authorizationRequest');
        $authorizationRequestDom = $this->domDocument->appendChild($domElement);

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

        $accountElement = $this->domDocument->createElement('account');

        return $authorizationRequestDom->appendChild($accountElement);
    }

    /**
     *
     *
     *
     * @return DOMNode
     */
    private function makeAccountNode(DOMNode $domNode)
    {
        $domElement = $this->domDocument->createElement('email', $this->authorization->getAccount()->getEmail());
        $domNode->appendChild($domElement);

        $typeElement = $this->domDocument->createElement('type', $this->authorization->getAccount()->getType());
        $domNode->appendChild($typeElement);

        return $domNode;
    }

    /**
     *
     *
     *
     * @return DOMNode
     */
    private function makePersonNode(DOMNode $domNode)
    {
        $domElement = $this->domDocument->createElement('person');
        $personDom = $domNode->appendChild($domElement);

        $nameElement = $this->domDocument->createElement('name', $this->authorization->getAccount()->getSeller()->getName());
        $personDom->appendChild($nameElement);

        $birthDateElement = $this->domDocument->createElement(
            'birthDate',
            $this->authorization->getAccount()->getSeller()->getBirthDate()
        );
        $personDom->appendChild($birthDateElement);

        return $personDom;
    }

    
    private function makePhonesNode(DOMNode $domNode): void
    {
        $domElement = $this->domDocument->createElement('phones');
        $phonesDom = $domNode->appendChild($domElement);
        $phones = $this->authorization->getAccount()->getSeller()->getPhones();

        $phoneElement = $this->domDocument->createElement('phone');
        $phoneDom = $phonesDom->appendChild($phoneElement);

        /**
         * @var Phone $phone
         */
        foreach ($phones as $phone) {
            $typeElement = $this->domDocument->createElement('type', $phone->getType());
            $phoneDom->appendChild($typeElement);

            $areaCodeElement = $this->domDocument->createElement('areaCode', $phone->getAreaCode());
            $phoneDom->appendChild($areaCodeElement);

            $numberElement = $this->domDocument->createElement('number', $phone->getNumber());
            $phoneDom->appendChild($numberElement);
        }
    }

    
    private function makeDocumentsNode(DOMNode $domNode): void
    {
        $domElement = $this->domDocument->createElement('documents');
        $documentsDom = $domNode->appendChild($domElement);
        $documents = $this->authorization->getAccount()->getSeller()->getDocuments();

        /**
         * @var Document $document
         */
        foreach ($documents as $document) {
            $documentElement = $this->domDocument->createElement('document');
            $documentDom = $documentsDom->appendChild($documentElement);

            $typeElement = $this->domDocument->createElement('type', $document->getType());
            $documentDom->appendChild($typeElement);

            $valueElement = $this->domDocument->createElement('value', $document->getIdentifier());
            $documentDom->appendChild($valueElement);
        }
    }

    
    private function makeAddressNode(DOMNode $domNode): void
    {
        $domElement = $this->domDocument->createElement('address');
        $addressDom = $domNode->appendChild($domElement);

        $postalCodeElement = $this->domDocument->createElement(
            'postalCode',
            $this->authorization->getAccount()->getSeller()->getAddress()->getPostalCode()
        );
        $addressDom->appendChild($postalCodeElement);

        $streetElement = $this->domDocument->createElement(
            'street',
            $this->authorization->getAccount()->getSeller()->getAddress()->getStreet()
        );
        $addressDom->appendChild($streetElement);

        $numberElement = $this->domDocument->createElement(
            'number',
            $this->authorization->getAccount()->getSeller()->getAddress()->getNumber()
        );
        $addressDom->appendChild($numberElement);

        $complementElement = $this->domDocument->createElement(
            'complement',
            $this->authorization->getAccount()->getSeller()->getAddress()->getComplement()
        );
        $addressDom->appendChild($complementElement);

        $districtElement = $this->domDocument->createElement(
            'district',
            $this->authorization->getAccount()->getSeller()->getAddress()->getDistrict()
        );
        $addressDom->appendChild($districtElement);

        $cityElement = $this->domDocument->createElement(
            'city',
            $this->authorization->getAccount()->getSeller()->getAddress()->getCity()
        );
        $addressDom->appendChild($cityElement);

        $stateElement = $this->domDocument->createElement(
            'state',
            $this->authorization->getAccount()->getSeller()->getAddress()->getState()
        );
        $addressDom->appendChild($stateElement);

        $countryElement = $this->domDocument->createElement(
            'country',
            $this->authorization->getAccount()->getSeller()->getAddress()->getCountry()
        );
        $addressDom->appendChild($countryElement);
    }

    /**
     * @return string
     */
    public function getAsXML()
    {
        return $this->domDocument->saveXML();
    }
}
