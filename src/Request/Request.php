<?php

namespace PagHipperSDK\Request;

use PagHipperSDK\Auth;
use PagHipperSDK\Exception\AuthException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use PagHipperSDK\Exception\ErrorException;

class Request
{
    const API = 'https://api.paghiper.com';

    /**
     * Api para autenticação
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Token para autenticação
     *
     * @var string
     */
    protected $token;

    /**
     * Request constructor.
     * @throws AuthException
     */
    public function __construct()
    {
        $this->apiKey = Auth::getApiKey();
        $this->token = Auth::getToken();

        if (!($this->apiKey) || !($this->token)) {
            throw new AuthException('ApiKey or Token missing', 400);
        }
    }

    /**
     * Enviar request para PagHiper
     *
     * @param string $method
     * @param $uri
     * @param \JsonSerializable|null $content
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ErrorException
     */
    public function sendRequest(string $method, $uri, \JsonSerializable $content = null)
    {
        try {
            $client = new \GuzzleHttp\Client([
                'base_uri' => self::API,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json;UTF-8',
                ],
            ]);

            $content = \GuzzleHttp\json_encode($content);

            $request = new Psr7\Request($method, $uri, [], $content);
            $response = $client->send($request);

            return $response;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $data = \GuzzleHttp\json_decode($e->getResponseBodySummary($e->getResponse()), true);

                if (($data = $data['create_request']) ?? false) {
                    throw new ErrorException($data['response_message'], $data['http_code']);
                }
            }

            throw new ErrorException('Undefined Error', 400);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            throw new ErrorException('Undefined Error', 400);
        } catch (\Exception $e) {
            throw new ErrorException('Undefined Error', 400);
        }
    }
}
