<?php

namespace PagHipperSDK\Response;

use PagHipperSDK\Exception\ErrorException;

class CancelTransaction
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
    protected $httpd_code;

    /**
     * Popula os objetos.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return CancelTransaction
     * @throws ErrorException
     */
    public static function populate(\Psr\Http\Message\ResponseInterface $response)
    {
        $data = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        $data = $data['cancellation_request'] ?? null;

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
        $class = new self;

        $class->result = $data['result'];
        $class->response_message = $data['response_message'];
        $class->httpd_code = $data['http_code'];

        return $class;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getResponseMessage(): string
    {
        return $this->response_message;
    }

    /**
     * @return string
     */
    public function getHttpdCode(): string
    {
        return $this->httpd_code;
    }
}
