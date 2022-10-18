<?php

namespace Brezgalov\WalletServiceApiClient\ResponseAdapters;

use Brezgalov\BaseApiClient\ResponseAdapters\BaseResponseAdapter;
use Brezgalov\WalletServiceApiClient\Dto\AccountDto;
use Brezgalov\WalletServiceApiClient\Dto\IAccountDto;

/**
 * Class AccountsCollection
 * @package Brezgalov\WalletServiceApiClient\ResponseAdapters
 */
class AccountsCollection extends BaseResponseAdapter implements \Iterator
{
    /**
     * @var int
     */
    protected $position = 0;

    /**
     * reset position
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return IAccountDto
     */
    public function current()
    {
        $items = $this->responseData['items'] ?? null;
        if (empty($items)) {
            return null;
        }

        if (!is_array($items) || !array_key_exists($this->position, $items)) {
            return null;
        }

        return (new AccountDto())->loadFromAccountObjectData($items[$this->position]);
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * change position
     */
    public function next()
    {
        $this->position += 1;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        $items = $this->responseData['items'] ?? null;

        return is_array($items) && array_key_exists($this->position, $items);
    }
}
