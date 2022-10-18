<?php

namespace Brezgalov\WalletServiceApiClient\Dto;

interface IAccountsListFilterDto
{
    /**
     * @return int|null
     */
    public function getAccountId();

    /**
     * @return int|null
     */
    public function getAuthId();

    /**
     * @return int|bool|null
     */
    public function getUsePaging();

    /**
     * @return int|null
     */
    public function getPage();

    /**
     * @return int|null
     */
    public function getPageSize();
}