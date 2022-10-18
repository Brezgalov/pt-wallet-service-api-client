<?php

namespace Brezgalov\WalletServiceApiClient\Dto;

class AccountsListFilterDto implements IAccountsListFilterDto
{
    /**
     * @var int
     */
    public $accountId;

    /**
     * @var int
     */
    public $authId;

    /**
     * @var int|bool
     */
    public $usePaging;

    /**
     * @var int
     */
    public $page;

    /**
     * @var int
     */
    public $pageSize;

    /**
     * @return int|null
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return int|null
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     * @return int|bool|null
     */
    public function getUsePaging()
    {
        return $this->usePaging;
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }
}