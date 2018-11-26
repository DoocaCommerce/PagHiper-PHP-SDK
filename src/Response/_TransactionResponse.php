<?php

namespace PagHipperSDK\Response;

/**
 * @method string getResult()
 * @method string getResponseMessage()
 * @method string getCreatedData()
 * @method string getValueCents()
 * @method string getTransactionId()
 * @method string getStatus()
 * @method string getOrderId()
 * @method string getDueData()
 * @method Shared\BankSlip getBankSlip()
 * @method int getHttpCode()
 */
class _TransactionResponse
{
    /**
     * @var string
     */
    protected $result;

    /**
     * @var string
     */
    protected $response_message;

    /**
     * @var string
     */
    protected $created_date;

    /**
     * @var string
     */
    protected $value_cents;

    /**
     * @var string
     */
    protected $transaction_id;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $order_id;

    /**
     * @var string
     */
    protected $due_date;

    /**
     * @var Shared\BankSlip
     */
    protected $bank_slip;

    /**
     * @var int
     */
    protected $http_code;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return CreateTransaction
     */
    public static function populate(\Psr\Http\Message\ResponseInterface $response)
    {
        // TODO: Checar status para ver se não deu error!
        $self = new self();
        $data = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        $data = $data['create_request'];

        $self->result = $data['result'];
        $self->response_message = $data['response_message'];
        $self->transaction_id = $data['transaction_id'];
        $self->created_date = $data['created_date'];
        $self->value_cents = $data['value_cents'];
        $self->status = $data['status'];
        $self->order_id = $data['order_id'];
        $self->due_date = $data['due_date'];
        $self->bank_slip = Shared\BankSlip::populate($data['bank_slip']);

        return $self;
    }

    public function __call($name, $arguments)
    {
        if ('get' !== substr($name, 0, 3)) {
            // TODO: não tem prefixo get ... throw exception
        }

        $property = \PagHipperSDK\Helpers::underscore(substr($name, 3));

        if (property_exists($this, $property)) {
            return $this->$property;
        }
        // TODO: Não encontrou o método... throw exception
    }
}
