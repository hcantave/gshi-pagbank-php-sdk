<?php
/**
 * Created by PhpStorm.
 * User: esilva
 * Date: 25/04/16
 * Time: 11:18
 */

namespace PagSeguro\Parsers\Transaction\Search\Abandoned;

/**
 * Class Response
 *
 * @package PagSeguro\Parsers\Transaction\Search\Abandoned
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
                self::addTransaction($transactions);
            } else {
                foreach ($transactions as $transaction) {
                    self::addTransaction($transaction);
                }
            }
        }
        return $this;
    }

    /**
     * @param $transaction
     */
    private function addTransaction($transaction): void
    {
        $response = new Transaction();
        $response->setDate(current($transaction->date))
            ->setCode(current($transaction->code))
            ->setReference(current($transaction->reference))
            ->setType(current($transaction->type))
            ->setGrossAmount(current($transaction->grossAmount))
            ->setRecoveryCode(current($transaction->recoveryCode));
        $this->transactions[] = $response;
    }
}
