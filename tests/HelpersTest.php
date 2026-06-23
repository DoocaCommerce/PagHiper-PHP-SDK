<?php

namespace PagHipperSDK\Tests;

use PHPUnit\Framework\TestCase;
use PagHipperSDK\Helpers;

class HelpersTest extends TestCase
{
    /** @test */
    public function normalizeCgc_removes_punctuation_from_cpf(): void
    {
        $this->assertSame('12345678901', Helpers::normalizeCgc('123.456.789-01'));
    }

    /** @test */
    public function normalizeCgc_removes_punctuation_from_numeric_cnpj(): void
    {
        $this->assertSame('12345678000195', Helpers::normalizeCgc('12.345.678/0001-95'));
    }

    /** @test */
    public function normalizeCgc_preserves_letters_from_alphanumeric_cnpj(): void
    {
        $this->assertSame('12ABC34501DE35', Helpers::normalizeCgc('12.ABC.345/01DE-35'));
    }

    /** @test */
    public function normalizeCgc_converts_to_uppercase(): void
    {
        $this->assertSame('12ABC34501DE35', Helpers::normalizeCgc('12.abc.345/01de-35'));
    }

    /** @test */
    public function normalizeCgc_accepts_already_normalized_input(): void
    {
        $this->assertSame('12ABC34501DE35', Helpers::normalizeCgc('12ABC34501DE35'));
    }

    /** @test */
    public function normalizeCgc_removes_spaces(): void
    {
        $this->assertSame('12ABC34501DE35', Helpers::normalizeCgc('12ABC 345 01DE 35'));
    }

    /** @test */
    public function normalizeCgc_removes_special_characters(): void
    {
        $this->assertSame('12ABC34501DE35', Helpers::normalizeCgc('12ABC345@01DE#35'));
    }

    /** @test */
    public function sanitizeNumber_still_works_for_phone(): void
    {
        $this->assertSame('11999998888', Helpers::sanitizeNumber('(11) 99999-8888'));
    }

    /** @test */
    public function sanitizeNumber_still_works_for_zip_code(): void
    {
        $this->assertSame('01310100', Helpers::sanitizeNumber('01310-100'));
    }
}
