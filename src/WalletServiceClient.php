<?php

namespace Brezgalov\WalletServiceApiClient;

use Brezgalov\BaseApiClient\BaseApiClient;
use Brezgalov\WalletServiceApiClient\Dto\IAccountsListFilterDto;
use Brezgalov\WalletServiceApiClient\ResponseAdapters\AccountResponseAdapter;
use Brezgalov\WalletServiceApiClient\ResponseAdapters\AccountsCollection;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\httpclient\Request;

/**
 * Class WalletServiceClient
 * @package Brezgalov\WalletServiceApiClient
 *
 * @property-write string $activityId
 * @property-write string $authToken
 * @property-write string $login
 * @property-write string $pass
 */
class WalletServiceClient extends BaseApiClient
{
    /**
     * @var string|null
     */
    private $activityId;

    /**
     * @var bool
     */
    private $useAuthToken = false;

    /**
     * @var bool
     */
    private $useBasicAuth = false;

    /**
     * @var string
     */
    private $authToken;

    /**
     * @var string
     */
    private $authLogin;

    /**
     * @var string
     */
    private $authPass;

    /**
     * @var Urls
     */
    public $urls;

    /**
     * @var string
     */
    public $authHeader = 'Authorization';

    /**
     * @var string
     */
    public $activityIdParameterName = 'activity_id';

    /**
     * WalletServiceClient constructor.
     * @param array $config
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        if (empty($this->urls)) {
            $this->urls = \Yii::createObject(Urls::class);
        }
    }

    /**
     * @param string|null $activityId
     * @return WalletServiceClient
     */
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;

        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setAuthToken(string $token)
    {
        $this->useAuthToken = true;
        $this->authToken = $token;

        return $this;
    }

    /**
     * @param string $login
     * @return $this
     */
    public function setLogin(string $login)
    {
        $this->useBasicAuth = true;
        $this->authLogin = $login;

        return $this;
    }

    /**
     * @param string $pass
     * @return $this
     */
    public function setPass(string $pass)
    {
        $this->useBasicAuth = true;
        $this->authPass = $pass;

        return $this;
    }

    /**
     * @param int $accountId
     * @param int $amountRub
     * @param int $amountCop
     * @param string $operationComment
     * @return AccountResponseAdapter|object
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function writeOffBalance(int $accountId, int $amountRub, int $amountCop, string $operationComment)
    {
        $request = $this->prepareRequest($this->urls->account->writeOff)
            ->setMethod('POST')
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                "account_id" => $accountId,
                "amount_rub" => $amountRub,
                "amount_cop" => $amountCop,
                "operation_name" => $operationComment,
            ]);

        return \Yii::createObject(AccountResponseAdapter::class, [
            "request" => $request,
            "response" => $request->send(),
        ]);
    }

    /**
     * @param int $accountId
     * @param int $amountRub
     * @param int $amountCop
     * @param string $operationComment
     * @return AccountResponseAdapter|object
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function replenishBalance(int $accountId, int $amountRub, int $amountCop, string $operationComment)
    {
        $request = $this->prepareRequest($this->urls->account->replenish)
            ->setMethod('POST')
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                "account_id" => $accountId,
                "amount_rub" => $amountRub,
                "amount_cop" => $amountCop,
                "operation_name" => $operationComment,
            ]);

        return \Yii::createObject(AccountResponseAdapter::class, [
            "request" => $request,
            "response" => $request->send(),
        ]);
    }

    /**
     * @param IAccountsListFilterDto|null $filter
     * @return AccountsCollection
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function listAccounts(IAccountsListFilterDto $filter = null)
    {
        $query = [];

        if ($filter) {
            if ($filter->getAccountId()) {
                $query["account_id"] = $filter->getAccountId();
            }

            if ($filter->getAuthId()) {
                $query["auth_id"] = $filter->getAuthId();
            }

            $query["use_paging"] = $filter->getUsePaging() ? 1 : 0;

            if ($filter->getUsePaging()) {
                $query['page'] = $filter->getPage();
                $query['page_size'] = $filter->getPageSize();
            }
        }

        $request = $this->prepareRequest($this->urls->account->list, $query);

        return \Yii::createObject(AccountsCollection::class, [
            "request" => $request,
            "response" => $request->send(),
        ]);
    }

    /**
     * @param string $route
     * @param array $queryParams
     * @param array $input
     * @param Request|null $request
     * @return \yii\httpclient\Message|Request
     * @throws InvalidConfigException
     */
    public function prepareRequest(string $route, array $queryParams = [], Request $request = null)
    {
        if ($this->activityId) {
            $queryParams[$this->activityIdParameterName] = $this->activityId;
        }

        $request = parent::prepareRequest($route, $queryParams, $request);

        if ($this->useAuthToken) {
            $request->addHeaders([
                $this->authHeader => "Bearer {$this->authToken}",
            ]);
        }

        if ($this->useBasicAuth) {
            $request->addHeaders([
                $this->authHeader => "Basic " . base64_encode("{$this->authLogin}:{$this->authPass}"),
            ]);
        }

        return $request;
    }
}