<?php

require dirname(__DIR__) . '/vendor/autoload.php';

\PagHipperSDK\Auth::init(
    '{API_KEY}',
    '{TOKEN}'
);

$pagHiper = new \PagHipperSDK\PagHiper();

$item_1 = (new PagHipperSDK\Entities\Item())
    ->setItemId('1')
    ->setDescription('Descrição do produto')
    ->setQuantity(1)
    ->setPriceCents(20);

$item_2 = (new PagHipperSDK\Entities\Item())
    ->setItemId('2')
    ->setDescription('Descrição do produto 2')
    ->setQuantity(2)
    ->setPriceCents(2000);

$payer = (new PagHipperSDK\Entities\Payer())
    ->setPayerEmail('webmaster@dooca.com.br')
    ->setPayerName('Webmaster Dooca')
    ->setPayerCpfCnpj('11144477735')
    ->setPayerPhone('5139393660')
    ->setPayerStreet('Rua Sapiranga')
    ->setPayerNumber(90)
    ->setPayerComplement('Sala 204')
    ->setPayerDistrict('Mauá')
    ->setPayerCity('Novo Hamburgo')
    ->setPayerState('RS')
    ->setPayerZipCode(93548192);

$transaction = (new \PagHipperSDK\Entities\Transaction())
    ->setOrderId('TESTE-' . rand(0, 10000))
    ->setNotificationUrl('http://uma-url.com.br')
    ->setDiscountCents(1100)
    ->setShippingPriceCents(2595)
    ->setShippingMethods('PAC')
    ->setFixedDescription(true)
    ->setDaysDueDate('5')
    ->setPayer($payer)
    ->setItems($item_1)
    ->setItems($item_2);

$transaction = $pagHiper->createTransaction($transaction);

echo $transaction->getResult() . PHP_EOL;
echo $transaction->getResponseMessage() . PHP_EOL;
echo $transaction->getTransactionId() . PHP_EOL;
echo $transaction->getCreatedDate() . PHP_EOL;
echo $transaction->getValueCents() . PHP_EOL;
echo $transaction->getStatus() . PHP_EOL;
echo $transaction->getOrderId() . PHP_EOL;
echo $transaction->getDueDate() . PHP_EOL;
echo $transaction->getBankSlip()->getDigitableLine() . PHP_EOL;
echo $transaction->getBankSlip()->getUrlSlip() . PHP_EOL;
echo $transaction->getBankSlip()->getUrlSlipPdf() . PHP_EOL;
echo $transaction->getHttpCode();
