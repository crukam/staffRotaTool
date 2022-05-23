<?php

use PHPUnit\Framework\TestCase;
use App\CustomClass\SingleManningRota;

class SingleManningRotaTest extends TestCase
{
    public function testSingleManningRotaIsObject()
    {
        $singleManningRota = new SingleManningRota();
        $this->assertIsObject($singleManningRota);
    }
    
    public function testBlackWidowWorkMonday()
    {
        
    }
}