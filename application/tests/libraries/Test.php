<?php 
use PHPUnit\Framework\TestCase;

class Test extends TestCase {
    
    public function testSomaInteiros() {
        $res = 5;
        $opr = 2 + 3;
        $this->assertEquals($res, $opr);
    }

}
