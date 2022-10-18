<?php

namespace Brezgalov\WalletServiceApiClient\Urls;

use yii\base\Component;

/**
 * Class Account
 * @package Brezgalov\WalletServiceApiClient\Urls
 *
 * @property-read string $list
 * @property-read string $replenish
 * @property-read string $writeOff
 */
class Account extends Component
{
    /**
     * @return string
     */
    public function getList()
    {
        return "account/list";
    }

    /**
     * @return string
     */
    public function getReplenish()
    {
        return "account/replenish";
    }

    /**
     * @return string
     */
    public function getWriteOff()
    {
        return "account/write-off";
    }
}