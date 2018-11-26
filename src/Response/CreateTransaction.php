<?php

namespace PagHipperSDK\Response;

use PagHipperSDK\Exception\ErrorException;
use PagHipperSDK\Helpers;

class CreateTransaction extends TransactionAbstract
{
    /**
     * @var string
     */
    protected $transaction_id;

    /**
     * @var string
     */
    protected $created_date;

    /**
     * Setta as propriedades da resposta de transição.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return static::class
     * @throws ErrorException
     */
    public static function populate(\Psr\Http\Message\ResponseInterface $response)
    {
        $data = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        $data = $data['create_request'] ?? null;

        // Caso não encontre resposta
        if (is_null($data)) {
            throw new ErrorException('Undefined Error', 400);
        }

        // Caso de erro ao criar transação
        if (201 !== $response->getStatusCode()) {
            $errorMessage = $data['response_message'] ?? null;
            throw new ErrorException($errorMessage, 400);
        }

        // Instancia a classe que ta extendendo a abstrata
        $class = new self();

        $class->result = $data['result'];
        $class->response_message = $data['response_message'];
        $class->transaction_id = $data['transaction_id'];
        $class->created_date = $data['created_date'];
        $class->value_cents = Helpers::centsToDecimal($data['value_cents']);
        $class->status = $data['status'];
        $class->order_id = $data['order_id'];
        $class->due_date = $data['due_date'];
        $class->bank_slip = Shared\BankSlip::populate($data['bank_slip']);
        $class->http_code = (int) $data['http_code'];

        return $class;
    }

    /**
     * @return string
     */
    public function getCreatedDate(): string
    {
        return $this->created_date;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transaction_id;
    }
}
