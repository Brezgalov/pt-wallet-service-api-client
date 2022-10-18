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
     * @return bool
     */
    public function getUsePaging()
    {
        return isset($this->responseData['pagination']);
    }

    /**
     * @return int|null
     */
    public function getPageSize()
    {
        return $this->responseData['page_size'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->responseData['page'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getTotalPages()
    {
        return $this->responseData['total_pages'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getTotalItemsCount()
    {
        return $this->responseData['total_items_count'] ?? null;
    }

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
