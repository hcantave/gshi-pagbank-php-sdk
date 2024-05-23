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
 * Class CompanySeller
 *
 * @package PagSeguro\Services\Authorization
 */
class CompanyService
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
        $companyNode = $this->makeCompanyNode($accountNode);
        $this->makePartnerNode($companyNode);
        $this->makePhonesNode($companyNode);
        $this->makeDocumentsNode($companyNode);
        $this->makeAddressNode($companyNode);
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
        $emailElement = $this->domDocument->createElement('email', $this->authorization->getAccount()->getEmail());
        $domNode->appendChild($emailElement);

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
    private function makeCompanyNode(DOMNode $domNode)
    {
        $companyElement = $this->domDocument->createElement('company');
        $companyDom = $domNode->appendChild($companyElement);

        $displayNameElement = $this->domDocument->createElement(
            'displayName',
            $this->authorization->getAccount()->getCompany()->getName()
        );
        $companyDom->appendChild($displayNameElement);

        $websiteURLElement = $this->domDocument->createElement(
            'websiteURL',
            $this->authorization->getAccount()->getCompany()->getWebsiteURL()
        );
        $companyDom->appendChild($websiteURLElement);

        return $companyDom;
    }

    
    private function makePartnerNode(DOMNode $domNode): void
    {
        $partnerElement = $this->domDocument->createElement('partner');
        $partnerDom = $domNode->appendChild($partnerElement);

        $partnerElement = $this->domDocument->createElement(
            'name',
            $this->authorization->getAccount()->getCompany()->getPartner()->getName()
        );
        $partnerDom->appendChild($partnerElement);

        if ($this->authorization->getAccount()->getCompany()->getPartner()->getPhones()) {
            $this->makePartnersPhonesNode($partnerDom);
        }
        if ($this->authorization->getAccount()->getCompany()->getPartner()->getDocuments()) {
            $this->makePartnerDocumentsNode($partnerDom);
        }
    }

    
    private function makePartnersPhonesNode(DOMNode $domNode): void
    {
        $phonesElement = $this->domDocument->createElement('phones');
        $phonesDom = $domNode->appendChild($phonesElement);
        $phones = $this->authorization->getAccount()->getCompany()->getPartner()->getPhones();

        $phoneElement = $this->domDocument->createElement('phone');
        $phoneDom = $phonesDom->appendChild($phoneElement);

        /**
         * @var Phone $phone
         */
        foreach ($phones as $phone) {
            $typeElement = $this->domDocument->createElement('areaCode', $phone->getAreaCode());
            $phoneDom->appendChild($typeElement);

            $valueElement = $this->domDocument->createElement('number', $phone->getNumber());
            $phoneDom->appendChild($valueElement);

            $valueElement = $this->domDocument->createElement('type', $phone->getType());
            $phoneDom->appendChild($valueElement);
        }
    }

    
    private function makePartnerDocumentsNode(DOMNode $domNode): void
    {
        $documentsElement = $this->domDocument->createElement('documents');
        $documentsDom = $domNode->appendChild($documentsElement);
        $documents = $this->authorization->getAccount()->getCompany()->getPartner()->getDocuments();

        $documentElement = $this->domDocument->createElement('document');
        $documentDom = $documentsDom->appendChild($documentElement);

        /**
         * @var Document $document
         */
        foreach ($documents as $document) {
            $typeElement = $this->domDocument->createElement('type', $document->getType());
            $documentDom->appendChild($typeElement);

            $valueElement = $this->domDocument->createElement('value', $document->getIdentifier());
            $documentDom->appendChild($valueElement);
        }
    }

    
    private function makePhonesNode(DOMNode $domNode): void
    {
        $phonesElement = $this->domDocument->createElement('phones');
        $phonesDom = $domNode->appendChild($phonesElement);
        $phones = $this->authorization->getAccount()->getCompany()->getPhones();

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
        $documentsElement = $this->domDocument->createElement('documents');
        $documentsDom = $domNode->appendChild($documentsElement);
        $documents = $this->authorization->getAccount()->getCompany()->getDocuments();

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
        $addressElement = $this->domDocument->createElement('address');
        $addressDom = $domNode->appendChild($addressElement);

        $postalCodeElement = $this->domDocument->createElement(
            'postalCode',
            $this->authorization->getAccount()->getCompany()->getAddress()->getPostalCode()
        );
        $addressDom->appendChild($postalCodeElement);

        $streetElement = $this->domDocument->createElement(
            'street',
            $this->authorization->getAccount()->getCompany()->getAddress()->getStreet()
        );
        $addressDom->appendChild($streetElement);

        $numberElement = $this->domDocument->createElement(
            'number',
            $this->authorization->getAccount()->getCompany()->getAddress()->getNumber()
        );
        $addressDom->appendChild($numberElement);

        $complementElement = $this->domDocument->createElement(
            'complement',
            $this->authorization->getAccount()->getCompany()->getAddress()->getComplement()
        );
        $addressDom->appendChild($complementElement);

        $districtElement = $this->domDocument->createElement(
            'district',
            $this->authorization->getAccount()->getCompany()->getAddress()->getDistrict()
        );
        $addressDom->appendChild($districtElement);

        $cityElement = $this->domDocument->createElement(
            'city',
            $this->authorization->getAccount()->getCompany()->getAddress()->getCity()
        );
        $addressDom->appendChild($cityElement);

        $stateElement = $this->domDocument->createElement(
            'state',
            $this->authorization->getAccount()->getCompany()->getAddress()->getState()
        );
        $addressDom->appendChild($stateElement);

        $countryElement = $this->domDocument->createElement(
            'country',
            $this->authorization->getAccount()->getCompany()->getAddress()->getCountry()
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
