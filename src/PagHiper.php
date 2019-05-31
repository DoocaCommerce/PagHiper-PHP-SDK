<?php

namespace PagHipperSDK;

use PagHipperSDK\Entities\Transaction;
use PagHipperSDK\Entities\TransactionListFilters;
use PagHipperSDK\Exception\ValidationException;
use PagHipperSDK\Request\Request;
use PagHipperSDK\Response\CancelTransaction;
use PagHipperSDK\Response\CreateTransaction;
use PagHipperSDK\Response\GetTransaction;

class PagHiper
{
    /**
     * Cria a transaction e retorna.
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

    /**
     * Busca transações.
     *
     * @param TransactionListFilters|null $filters
     * @return mixed
     * @throws Exception\AuthException
     * @throws Exception\ErrorException
     */
    public function listTransactions(?TransactionListFilters $filters)
    {
        $response = (new Request())->sendRequest('POST', '/transaction/list/', $filters);

        // TODO: fazer um response para essa lista
        return \GuzzleHttp\json_decode($response->getBody()->getContents())->transaction_list_request;
    }

    /**
     * Consulta uma transicação.
     *
     * @param string $transactionId
     * @return GetTransaction
     * @throws Exception\AuthException
     * @throws Exception\ErrorException
     */
    public function getTransaction(string $transactionId)
    {
        $transaction = new Transaction();
        $transaction->setTransactionId($transactionId);

        $response = (new Request())->sendRequest('POST', '/transaction/status/', $transaction);

        return GetTransaction::populate($response);
    }

    /**
     * Cancela uma transição.
     *
     * @param string $transactionId
     * @return CancelTransaction
     * @throws Exception\AuthException
     * @throws Exception\ErrorException
     * @throws ValidationException
     */
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

    /**
     * Consulta uma notificação.
     *
     * @param Transaction $transaction
     * @return GetTransaction
     * @throws Exception\AuthException
     * @throws Exception\ErrorException
     */
    public function getNotification(Transaction $transaction)
    {
        $response = (new Request())->sendRequest('POST', '/transaction/notification/', $transaction);

        // Utilizando o Response da getTransaction, não tem todos os campos, porém possuí todos os necessários
        return GetTransaction::populate($response);
    }
}
