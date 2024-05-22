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

namespace PagSeguro\Domains;

class PreApproval
{
    private $charge;
    private $name;
    private $details;
    private $amountPerPayment;
    private $maxAmountPerPayment;
    private $maxTotalAmount;
    private $maxAmountPerPeriod;
    private $maxPaymentsPerPeriod;
    private $period;
    private $initialDate;
    private $finalDate;

    /**
     * @return mixed
     */
    public function getAmountPerPayment()
    {
        return $this->amountPerPayment;
    }

    /**
     * @return PreApproval
     */
    public function setAmountPerPayment(mixed $amountPerPayment)
    {
        $this->amountPerPayment = $amountPerPayment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @return PreApproval
     */
    public function setCharge(mixed $charge)
    {
        $this->charge = $charge;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @return PreApproval
     */
    public function setDetails(mixed $details)
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFinalDate()
    {
        return $this->finalDate;
    }

    /**
     * @return PreApproval
     */
    public function setFinalDate(mixed $finalDate)
    {
        $this->finalDate = $finalDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInitialDate()
    {
        return $this->initialDate;
    }

    /**
     * @return PreApproval
     */
    public function setInitialDate(mixed $initialDate)
    {
        $this->initialDate = $initialDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxAmountPerPeriod()
    {
        return $this->maxAmountPerPeriod;
    }

    /**
     * @return PreApproval
     */
    public function setMaxAmountPerPeriod(mixed $maxAmountPerPeriod)
    {
        $this->maxAmountPerPeriod = $maxAmountPerPeriod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxAmountPerPayment()
    {
        return $this->maxAmountPerPayment;
    }

    /**
     * @return PreApproval
     */
    public function setMaxAmountPerPayment(mixed $maxAmountPerPayment)
    {
        $this->maxAmountPerPayment = $maxAmountPerPayment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxPaymentsPerPeriod()
    {
        return $this->maxPaymentsPerPeriod;
    }

    /**
     * @param $maxPaymentsPerPeriod
     * @return $this
     */
    public function setMaxPaymentsPerPeriod($maxPaymentsPerPeriod)
    {
        $this->maxPaymentsPerPeriod = $maxPaymentsPerPeriod;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getMaxTotalAmount()
    {
        return $this->maxTotalAmount;
    }

    /**
     * @return PreApproval
     */
    public function setMaxTotalAmount(mixed $maxTotalAmount)
    {
        $this->maxTotalAmount = $maxTotalAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return PreApproval
     */
    public function setName(mixed $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return PreApproval
     */
    public function setPeriod(mixed $period)
    {
        $this->period = $period;
        return $this;
    }
}
