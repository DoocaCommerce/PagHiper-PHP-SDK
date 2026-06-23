<?php

namespace PagHipperSDK\Tests;

use PHPUnit\Framework\TestCase;
use PagHipperSDK\Entities\Payer;

class PayerTest extends TestCase
{
    /** @test */
    public function setPayerCpfCnpj_accepts_plain_cpf(): void
    {
        $payer = new Payer();
        $payer->setPayerCpfCnpj('12345678901');

        $this->assertSame('12345678901', $payer->getPayerCpfCnpj());
    }

    /** @test */
    public function setPayerCpfCnpj_normalizes_masked_cpf(): void
    {
        $payer = new Payer();
        $payer->setPayerCpfCnpj('123.456.789-01');

        $this->assertSame('12345678901', $payer->getPayerCpfCnpj());
    }

    /** @test */
    public function setPayerCpfCnpj_accepts_numeric_cnpj(): void
    {
        $payer = new Payer();
        $payer->setPayerCpfCnpj('12345678000195');

        $this->assertSame('12345678000195', $payer->getPayerCpfCnpj());
    }

    /** @test */
    public function setPayerCpfCnpj_normalizes_masked_numeric_cnpj(): void
    {
        $payer = new Payer();
        $payer->setPayerCpfCnpj('12.345.678/0001-95');

        $this->assertSame('12345678000195', $payer->getPayerCpfCnpj());
    }

    /** @test */
    public function setPayerCpfCnpj_accepts_alphanumeric_cnpj_without_mask(): void
    {
        $payer = new Payer();
        $payer->setPayerCpfCnpj('12ABC34501DE35');

        $this->assertSame('12ABC34501DE35', $payer->getPayerCpfCnpj());
    }

    /** @test */
    public function setPayerCpfCnpj_normalizes_masked_alphanumeric_cnpj(): void
    {
        $payer = new Payer();
        $payer->setPayerCpfCnpj('12.ABC.345/01DE-35');

        $this->assertSame('12ABC34501DE35', $payer->getPayerCpfCnpj());
    }

    /** @test */
    public function setPayerCpfCnpj_converts_alphanumeric_cnpj_to_uppercase(): void
    {
        $payer = new Payer();
        $payer->setPayerCpfCnpj('12.abc.345/01de-35');

        $this->assertSame('12ABC34501DE35', $payer->getPayerCpfCnpj());
    }

    /** @test */
    public function setPayerCpfCnpj_accepts_empty_string_without_exception(): void
    {
        $payer = new Payer();
        $payer->setPayerCpfCnpj('');

        $this->assertSame('', $payer->getPayerCpfCnpj());
    }

    /** @test */
    public function setPayerCpfCnpj_accepts_null_coercing_to_empty_string(): void
    {
        $payer = new Payer();
        $payer->setPayerCpfCnpj(null);

        $this->assertSame('', $payer->getPayerCpfCnpj());
    }
}
