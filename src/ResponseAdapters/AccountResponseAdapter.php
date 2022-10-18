<?php

namespace Brezgalov\WalletServiceApiClient\ResponseAdapters;

use Brezgalov\BaseApiClient\ResponseAdapters\BaseResponseAdapter;
use Brezgalov\WalletServiceApiClient\Dto\IAccountDto;

class AccountResponseAdapter extends BaseResponseAdapter implements IAccountDto
{
    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->responseData['account_id'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getUserOwnerId()
    {
        return $this->responseData['user_owner_id'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getUserOwnerAuthId()
    {
        return $this->responseData['user_owner_auth_id'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getBalanceCop()
    {
        return $this->responseData['balance_cop'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getBalanceRub()
    {
        return $this->responseData['balance_rub'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->responseData['created_at'] ?? null;
    }
}