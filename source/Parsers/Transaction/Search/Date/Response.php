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

namespace PagSeguro\Parsers\Transaction\Search\Date;

/**
 * Class Response
 *
 * @package PagSeguro\Parsers\Transaction\Search\Date
 */
class Response
{
    /**
     * @var
     */
    private $date;
    /**
     * @var
     */
    private $resultsInThisPage;
    /**
     * @var
     */
    private $transactions;
    /**
     * @var
     */
    private $currentPage;
    /**
     * @var
     */
    private $totalPages;

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @return Response
     */
    public function setCurrentPage(mixed $currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Response
     */
    public function setDate(mixed $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResultsInThisPage()
    {
        return $this->resultsInThisPage;
    }

    /**
     * @return Response
     */
    public function setResultsInThisPage(mixed $resultsInThisPage)
    {
        $this->resultsInThisPage = $resultsInThisPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @return Response
     */
    public function setTotalPages(mixed $totalPages)
    {
        $this->totalPages = $totalPages;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @return Response
     */
    public function setTransactions(mixed $transactions)
    {
        if ($transactions) {
            if (is_object($transactions)) {
                self::addTransactions($transactions);
            } else {
                foreach ($transactions as $transaction) {
                    self::addTransactions($transaction);
                }
            }
        }
        return $this;
    }

    /**
     * @param $transaction
     */
    public function addTransactions($transaction): void
    {
        //check if is an array of transactions if is just push to array
        if (is_array($transaction)) {
            foreach ($transaction as $item) {
                $this->transactions[] = $item;
            }
            return;
        }
        //create a new transaction and push to array
        $response = $this->createTransaction($transaction);
        $this->transactions[] = $response;
    }

    private function createTransaction($response)
    {
        $transaction = new Transaction();
        $transaction->setDate(current($response->date))
            ->setCode(current($response->code))
            ->setReference(current($response->reference))
            ->setType(current($response->type))
            ->setStatus(current($response->status))
            ->setLastEventDate(current($response->lastEventDate))
            ->setPaymentMethod($response->paymentMethod)
            ->setGrossAmount(current($response->grossAmount))
            ->setDiscountAmount(current($response->discountAmount))
            ->setNetAmount(current($response->netAmount))
            ->setExtraAmount(current($response->extraAmount))
            ->setCancellationSource(current($response->cancellationSource));
        return $transaction;
    }
}
