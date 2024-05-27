<?php

namespace PagSeguro\Domains;

use PagSeguro\Domains\Authorization\Account;

/**
 * Class Seller
 */
class Authorization
{
    /**
     * Seller constructor.
     *
     * @param  Account  $account  * @param string $reference
     */
    public function __construct(private $reference, private $permissions, private $redirectURL, private $notificationURL, private ?Account $account = null)
    {
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @return mixed
     */
    public function getRedirectURL()
    {
        return $this->redirectURL;
    }

    /**
     * @return mixed
     */
    public function getNotificationURL()
    {
        return $this->notificationURL;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
