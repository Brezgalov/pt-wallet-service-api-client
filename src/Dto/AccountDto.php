<?php

namespace Brezgalov\WalletServiceApiClient\Dto;

class AccountDto implements IAccountDto
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userOwnerId;

    /**
     * @var int
     */
    private $userOwnerAuthId;

    /**
     * @var int
     */
    private $balanceCop;

    /**
     * @var int
     */
    private $balancRub;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @param array $data
     * @return $this
     */
    public function loadFromAccountObjectData(array $data)
    {
        $this->id = $data['id'] ?? $this->id;
        $this->userOwnerId = $data['user_owner_id'] ?? $this->id;
        $this->userOwnerAuthId = $data['user_owner_auth_id'] ?? $this->id;
        $this->balanceCop = $data['balance_cop'] ?? $this->id;
        $this->balancRub = $data['balance_rub'] ?? $this->id;
        $this->createdAt = $data['created_at'] ?? $this->id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getUserOwnerId()
    {
        return $this->userOwnerId;
    }

    /**
     * @return int|null
     */
    public function getUserOwnerAuthId()
    {
        return $this->userOwnerAuthId;
    }

    /**
     * @return int|null
     */
    public function getBalanceCop()
    {
        return $this->balanceCop;
    }

    /**
     * @return int|null
     */
    public function getBalanceRub()
    {
        return $this->balancRub;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}