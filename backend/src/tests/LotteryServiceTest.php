<?php
use PHPUnit\Framework\TestCase;

class LotteryServiceTest extends TestCase
{
    public function testGenerateDezenas()
    {
        $service = new LotteryService();
        $dezenas = $service->generateDezenas(6);
        $this->assertCount(6, $dezenas);
        $this->assertEquals(count($dezenas), count(array_unique($dezenas))); 
    }

    public function testGenerateTickets()
    {
        $service = new LotteryService();
        $tickets = $service->generateTickets(1, 6, 2);
        $this->assertCount(2, $tickets);  
    }
}
?>
