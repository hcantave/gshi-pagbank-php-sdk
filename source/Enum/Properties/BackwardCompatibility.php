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
 *
 */

namespace PagSeguro\Enum\Properties;

/**
 * Class BackwardCompatibility
 * @package PagSeguro\Enum\Properties
 */
class BackwardCompatibility
{

    /**
     *  Application ID
     */
    public const APP_ID = "appId";

    /**
     *  Application Key
     */
    public const APP_KEY = "appKey";

    /**
     * Shipping address street
     */
    public const BILLING_ADDRESS_STREET = "billingAddress.street";

    /**
     * Shipping address number
     */
    public const BILLING_ADDRESS_NUMBER = "billingAddress.number";

    /**
     * Shipping address complement
     */
    public const BILLING_ADDRESS_COMPLEMENT = "billingAddress.complement";

    /**
     *  Shipping address city
     */
    public const BILLING_ADDRESS_CITY = "billingAddress.city";

    /**
     *  Shipping address state
     */
    public const BILLING_ADDRESS_STATE = "billingAddress.state";

    /**
     *  Shipping address district
     */
    public const BILLING_ADDRESS_DISTRICT = "billingAddress.district";

    /**
     * Shipping address postal code
     */
    public const BILLING_ADDRESS_POSTAL_CODE = "billingAddress.postalCode";

    /**
     *  Shipping address country
     */
    public const BILLING_ADDRESS_COUNTRY = "billingAddress.country";

    /**
     *  Currency
     */
    public const CURRENCY = "currency";

    /**
     *  Extra amount
     */
    public const CURRENCY_EXTRA_AMOUNT = "extraAmount";

    /**
     * Credit card holder name for credit card direct payment
     */
    public const CREDIT_CARD_HOLDER_NAME = 'creditCard.holder.name';

    /**
     * Credit card holder birth date for credit card direct payment
     */
    public const CREDIT_CARD_HOLDER_BIRTH_DATE = 'creditCard.holder.birthDate';

    /**
     * Credit card holder cpf for credit card direct payment
     */
    public const CREDIT_CARD_HOLDER_CPF = 'creditCard.holder.CPF';

    /**
     * Credit card holder area code for credit card direct payment
     */
    public const CREDIT_CARD_HOLDER_AREA_CODE = 'creditCard.holder.areaCode';

    /**
     * Credit card holder phone for credit card direct payment
     */
    public const CREDIT_CARD_HOLDER_PHONE = 'creditCard.holder.phone';

    /**
     * Credit card token for credit card direct payment
     */
    public const CREDIT_CARD_TOKEN = "creditCard.token";

    /**
     *  Payment mode
     */
    public const DIRECT_PAYMENT_MODE = "payment.mode";

    /**
     *  Payment method
     */
    public const DIRECT_PAYMENT_METHOD = "payment.method";

    /**
     * Installment quantity for credit card payment
     */
    public const INSTALLMENT_QUANTITY = "installment.quantity";

    /**
     * Installment value for credit card payment
     */
    public const INSTALLMENT_VALUE = "installment.value";

    /**
     * Installment no interest installment quantity for credit card payment
     */
    public const INSTALLMENT_NO_INTEREST_INSTALLMENT_QUANTITY = "installment.noInterestInstallmentQuantity";

    /**
     *  Item id
     */
    public const ITEM_ID = "item[%s].id";

    /**
     *  Item description
     */
    public const ITEM_DESCRIPTION = "item[%s].description";

    /**
     *  Item amount
     */
    public const ITEM_AMOUNT = "item[%s].amount";

    /**
     *  Item quantity
     */
    public const ITEM_QUANTITY = "item[%s].quantity";

    /**
     * Item weight
     */
    public const ITEM_WEIGHT = "item[%s].weight";

    /**
     *  Notification URL
     */
    public const NOTIFICATION_URL = "notificationURL";

    /**
     *  Bank name
     */
    public const ONLINE_DEBIT_BANK_NAME = "bank.name";

    /**
     * Receiver email
     */
    public const RECEIVER_EMAIL = 'receiver.email';

    /**
     *  Receiver public key
     */
    public const RECEIVER_PUBLIC_KEY = "receiver[%s].publicKey";

    /**
     * Redirect Url
     */
    public const REDIRECT_URL = "redirectURL";

    /**
     *  Reference
     */
    public const REFERENCE = "reference";

    /**
     * Sender name
     */
    public const SENDER_NAME = "sender.name";

    /**
     * Sender email
     */
    public const SENDER_EMAIL = "sender.email";

    /**
     * Sender hash
     */
    public const SENDER_HASH = "sender.hash";

    /**
     * Sender ip number
     */
    public const SENDER_IP = "sender.ip";

    /**
     *  Sender area code
     */
    public const SENDER_PHONE_AREA_CODE = "sender.areaCode";

    /**
     * Sender phone number
     */
    public const SENDER_PHONE_NUMBER = "sender.phone";

    /**
     *  Sender CPF
     */
    public const SENDER_DOCUMENT_CPF = "sender.CPF";

    /**
     * Sender CNPJ
     */
    public const SENDER_DOCUMENT_CNPJ = "sender.CNPJ";

    /**
     * Shipping type
     */
    public const SHIPPING_TYPE = "shipping.type";

    /**
     * Shipping cost
     */
    public const SHIPPING_COST = "shipping.cost";

    /**
     * Shipping address street
     */
    public const SHIPPING_ADDRESS_STREET = "shipping.address.street";

    /**
     * Shipping address number
     */
    public const SHIPPING_ADDRESS_NUMBER = "shipping.address.number";

    /**
     * Shipping address complement
     */
    public const SHIPPING_ADDRESS_COMPLEMENT = "shipping.address.complement";

    /**
     *  Shipping address city
     */
    public const SHIPPING_ADDRESS_CITY = "shipping.address.city";

    /**
     *  Shipping address state
     */
    public const SHIPPING_ADDRESS_STATE = "shipping.address.state";

    /**
     *  Shipping address district
     */
    public const SHIPPING_ADDRESS_DISTRICT = "shipping.address.district";

    /**
     * Shipping address postal code
     */
    public const SHIPPING_ADDRESS_POSTAL_CODE = "shipping.address.postalCode";

    /**
     *  Shipping address country
     */
    public const SHIPPING_ADDRESS_COUNTRY = "shipping.address.country";

    /**
     * Shipping address required
     */
    public const SHIPPING_ADDRESS_REQUIRED = "shipping.address.required";

    /**
     *  Primary Key
     */
    public const PRIMARY_RECEIVER_PUBLIC_KEY = "primaryReceiver.publicKey";
}
