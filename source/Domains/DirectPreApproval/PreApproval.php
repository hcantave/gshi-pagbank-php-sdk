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

namespace PagSeguro\Domains\DirectPreApproval;

/**
 * Class PreApproval
 *
 * @package PagSeguro\Domains\DirectPreApproval
 */
class PreApproval
{
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $charge;
    /**
     * @var
     */
    public $period;
    /**
     * @var
     */
    public $amountPerPayment;
    /**
     * @var
     */
    public $membershipFee;
    /**
     * @var
     */
    public $trialPeriodDuration;
    /**
     * @var Expiration
     */
    public $expiration;
    /**
     * @var
     */
    public $details;
    /**
     * @var
     */
    public $maxAmountPerPeriod;
    /**
     * @var
     */
    public $maxAmountPerPayment;
    /**
     * @var
     */
    public $maxTotalAmount;
    /**
     * @var
     */
    public $maxPaymentsPerPeriod;
    /**
     * @var
     */
    public $initialDate;
    /**
     * @var
     */
    public $finalDate;
    /**
     * @var
     */
    public $dayOfYear;
    /**
     * @var
     */
    public $dayOfMonth;
    /**
     * @var
     */
    public $dayOfWeek;
    /**
     * @var
     */
    public $cancelURL;

    /**
     * PreApproval constructor.
     */
    public function __construct()
    {
        $this->expiration = new Expiration();
    }

    /**
     * @param $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param $charge
     */
    public function setCharge($charge): void
    {
        $this->charge = $charge;
    }

    /**
     * @param $period
     */
    public function setPeriod($period): void
    {
        $this->period = $period;
    }

    /**
     * @param $amountPerPayment
     */
    public function setAmountPerPayment($amountPerPayment): void
    {
        $this->amountPerPayment = $amountPerPayment;
    }

    /**
     * @param $membershipFee
     */
    public function setMembershipFee($membershipFee): void
    {
        $this->membershipFee = $membershipFee;
    }

    /**
     * @param $trialPeriodDuration
     */
    public function setTrialPeriodDuration($trialPeriodDuration): void
    {
        $this->trialPeriodDuration = $trialPeriodDuration;
    }

    /**
     * @return Expiration
     */
    public function setExpiration()
    {
        return $this->expiration;
    }

    /**
     * @param $details
     */
    public function setDetails($details): void
    {
        $this->details = $details;
    }

    /**
     * @param $maxAmountPerPeriod
     */
    public function setMaxAmountPerPeriod($maxAmountPerPeriod): void
    {
        $this->maxAmountPerPeriod = $maxAmountPerPeriod;
    }

    /**
     * @param $maxAmountPerPayment
     */
    public function setMaxAmountPerPayment($maxAmountPerPayment): void
    {
        $this->maxAmountPerPayment = $maxAmountPerPayment;
    }

    /**
     * @param $maxTotalAmount
     */
    public function setMaxTotalAmount($maxTotalAmount): void
    {
        $this->maxTotalAmount = $maxTotalAmount;
    }

    /**
     * @param $maxPaymentsPerPeriod
     */
    public function setMaxPaymentsPerPeriod($maxPaymentsPerPeriod): void
    {
        $this->maxPaymentsPerPeriod = $maxPaymentsPerPeriod;
    }

    /**
     * @param $initialDate
     */
    public function setInitialDate($initialDate): void
    {
        $this->initialDate = $initialDate;
    }

    /**
     * @param $finalDate
     */
    public function setFinalDate($finalDate): void
    {
        $this->finalDate = $finalDate;
    }

    /**
     * @param $dayOfYear
     */
    public function setDayOfYear($dayOfYear): void
    {
        $this->dayOfYear = $dayOfYear;
    }

    /**
     * @param $dayOfMonth
     */
    public function setDayOfMonth($dayOfMonth): void
    {
        $this->dayOfMonth = $dayOfMonth;
    }

    /**
     * @param $dayOfWeek
     */
    public function setDayOfWeek($dayOfWeek): void
    {
        $this->dayOfWeek = $dayOfWeek;
    }

    /**
     * @param $cancelURL
     */
    public function setCancelURL($cancelURL): void
    {
        $this->cancelURL = $cancelURL;
    }
}
