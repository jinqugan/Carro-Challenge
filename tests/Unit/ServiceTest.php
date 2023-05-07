<?php

namespace Tests\Unit;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function test_mpt_service_invoice_amount(): void
    {
        $month = 2;
        $mptService = new Mpt();
        $result = $mptService->calculate($month);

        $this->assertEquals(200 * ($month ?? 1), $result);
    }

    public function test_ooredoo_service_invoice_amount(): void
    {
        $month = 1;
        $service = new Ooredoo();
        $result = $service->calculate($month);

        $this->assertEquals(150 * ($month ?? 1), $result);
    }
}
