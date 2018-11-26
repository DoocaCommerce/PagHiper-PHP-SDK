<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$notificaitonId = $_POST['notification_id'];
$transactionId = $_POST['transaction_id'];

\PagHipperSDK\Auth::init(
    '{API_KEY}',
    '{TOKEN}'
);

$transaction = new \PagHipperSDK\Entities\Transaction();

$transaction->setTransactionId($transactionId);
$transaction->setNotificationId($notificaitonId);

$pagHiper = new \PagHipperSDK\PagHiper();

$notification = $pagHiper->getNotification($transaction);

// TODO: retorno...