<?php

namespace PagHipperSDK;

use PagHipperSDK\Entities\Transaction;
use PagHipperSDK\Exception\ValidationException;
use PagHipperSDK\Request\Request;
use PagHipperSDK\Response\CancelTransaction;
use PagHipperSDK\Response\CreateTransaction;
use PagHipperSDK\Response\GetTransaction;

class PagHiper
{
    public function __construct()
    {
    }
    /**
     * Cria a transaction e retorna
     *
     * @param Transaction $transaction
     * @return CreateTransaction
     * @throws Exception\AuthException
     * @throws Exception\ErrorException
     */
    public function createTransaction(Transaction $transaction)
    {
        $response = (new Request())->sendRequest('POST', '/transaction/create/', $transaction);

        return CreateTransaction::populate($response);
    }

    public function getTransaction(string $transactionId)
    {
        if (!($transactionId ?? false)) {
            throw new ValidationException('Missing transaction_id', 400);
        }

        $transaction = new Transaction();
        $transaction->setTransactionId($transactionId);

        $response = (new Request())->sendRequest('POST', '/transaction/status/', $transaction);

        return GetTransaction::populate($response);
    }

    public function cancelTransaction(string $transactionId)
    {
        if (!($transactionId ?? false)) {
            throw new ValidationException('Missing transaction_id', 400);
        }

        $transaction = new Transaction();
        $transaction->setTransactionId($transactionId);
        $transaction->setStatus('canceled');

        $response = (new Request())->sendRequest('POST', '/transaction/cancel/', $transaction);

        return CancelTransaction::populate($response);
    }

    public function getNotification(Transaction $transaction)
    {
        $response = (new Request())->sendRequest('POST', '/transaction/notification/', $transaction);

        var_dump($response);
        die;
        // TODO: send notification request
    }
}
