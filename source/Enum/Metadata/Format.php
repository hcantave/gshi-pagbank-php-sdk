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

namespace PagSeguro\Enum\Metadata;

use PagSeguro\Enum\Enum;

/**
 * Class Format
 *
 * Describes each format expected by each parameter of the metadata
 *
 * @package PagSeguro\Enum\Metadata
 */
class Format extends Enum
{
    public const PASSENGER_CPF = '[0-9]{11}';
    public const PASSENGER_PASSPORT = '.+';
    public const ORIGIN_CITY = '.+';
    public const DESTINATION_CITY = '.+';
    public const ORIGIN_AIRPORT_CODE = '.+';
    public const DESTINATION_AIRPORT_CODE = '.+';
    public const GAME_NAME = '.+';
    public const PLAYER_ID = '.+';
    public const TIME_IN_GAME_DAYS = '[0-9]+';
    public const MOBILE_NUMBER = '([0-9]{2})?([0-9]{2})([0-9]{4,5}[0-9]{4})';
    public const PASSENGER_NAME = '.+';
}
