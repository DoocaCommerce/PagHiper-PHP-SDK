<?php

require dirname(__DIR__) . '/vendor/autoload.php';

\PagHipperSDK\Auth::init(
    '{API_KEY}',
    '{TOKEN}'
);

$pagHiper = new \PagHipperSDK\PagHiper();

$transaction = $pagHiper->getTransaction('J9ZK18SNCGDJFABK');

echo $transaction->getResult() . PHP_EOL;
echo $transaction->getResponseMessage() . PHP_EOL;
echo $transaction->getOrderId() . PHP_EOL;
echo $transaction->getStatus() . PHP_EOL;
echo $transaction->getStatusDate() . PHP_EOL;
echo $transaction->getDueDate() . PHP_EOL;
echo $transaction->getValueCents() . PHP_EOL;
echo $transaction->getValueCentsPaid() . PHP_EOL; // Pode ser null
echo $transaction->getLatePaymentFine() . PHP_EOL; // Pode ser null
echo $transaction->isPerDayInterest() . PHP_EOL; // Pode ser null
echo $transaction->getEarlyPaymentDiscountsDays() . PHP_EOL; // Pode ser null
echo $transaction->getEarlyPaymentDiscountsCents() . PHP_EOL; // Pode ser null
echo $transaction->getOpenAfterDayDue() . PHP_EOL; // Pode ser null
echo $transaction->getBankSlip()->getDigitableLine() . PHP_EOL;
echo $transaction->getBankSlip()->getUrlSlip() . PHP_EOL;
echo $transaction->getHttpCode() . PHP_EOL;
