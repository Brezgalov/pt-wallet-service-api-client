<?php

namespace Brezgalov\WalletServiceApiClient;

use Brezgalov\WalletServiceApiClient\Urls\Account;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Class Urls
 * @package Brezgalov\WalletServiceApiClient
 *
 * @property-read Account $account
 */
class Urls extends Component
{
    /**
     * @return Account
     * @throws InvalidConfigException
     */
    public function getAccount()
    {
        return \Yii::createObject(Account::class);
    }
}