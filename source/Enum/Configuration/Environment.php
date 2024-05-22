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

namespace PagSeguro\Enum\Configuration;

use PagSeguro\Enum\Enum;

class Environment extends Enum
{
    //Environment
    public const ENV = 'PAGSEGURO_ENV';

    //Credentials
    public const EMAIL = 'PAGSEGURO_EMAIL';
    public const TOKEN_PRODUCTION = 'PAGSEGURO_TOKEN_PRODUCTION';
    public const TOKEN_SANDBOX = 'PAGSEGURO_TOKEN_SANDBOX';
    public const APP_ID_PRODUCTION = 'PAGSEGURO_APP_ID_PRODUCTION';
    public const APP_ID_SANDBOX = 'PAGSEGURO_APP_ID_SANDBOX';
    public const APP_KEY_PRODUCTION = 'PAGSEGURO_APP_KEY_PRODUCTION';
    public const APP_KEY_SANDBOX = 'PAGSEGURO_APP_KEY_SANDBOX';

    //Encoding
    public const CHARSET = 'PAGSEGURO_CHARSET';

    //Log
    public const LOG_ACTIVE = 'PAGSEGURO_LOG_ACTIVE';
    public const LOG_LOCATION = 'PAGSEGURO_LOG_LOCATION';
}
