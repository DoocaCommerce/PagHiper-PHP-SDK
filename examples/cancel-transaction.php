<?php

require dirname(__DIR__) . '/vendor/autoload.php';

\PagHipperSDK\Auth::init(
    '{API_KEY}',
    '{TOKEN}'
);

$pagHiper = new \PagHipperSDK\PagHiper();

$response = $pagHiper->cancelTransaction('{transaction_id}');

echo $response->getResult() . PHP_EOL;
echo $response->getResponseMessage() . PHP_EOL;
echo $response->getHttpdCode() . PHP_EOL;
