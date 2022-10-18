<?php

namespace Brezgalov\WalletServiceApiClient\Dto;

interface IAccountDto
{
    /**
     * @return int|null
     */
    public function getId();

    /**
     * @return int|null
     */
    public function getUserOwnerId();

    /**
     * @return int|null
     */
    public function getUserOwnerAuthId();

    /**
     * @return int|null
     */
    public function getBalanceCop();

    /**
     * @return int|null
     */
    public function getBalanceRub();

    /**
     * @return int|null
     */
    public function getCreatedAt();
}
