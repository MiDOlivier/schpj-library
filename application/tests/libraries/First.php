<?php 

class First extends TestCase {
    
    public function setUp(): void {
        $this->resetInstance();
    }

    function xtestContaDeveInserirRegistroCorretamente() {
        // cenário
        $this->CI->load->library('builder/ContaDataBuilder', null, 'builder');
        $this->CI->builder->clear();
        $this->CI->builder->start();

        // ação
        $this->CI->load->library('conta');
        $res = $this->CI->conta->lista('pagar', 1, 2021);

        // verificação
        $this->assertEquals('Magalu', $res[0]['parceiro']);
        $this->assertEquals(2021, $res[0]['ano']);
        $this->assertEquals(1, $res[0]['mes']);
        $this->assertEquals(3, sizeof($res));

        $this->assertEquals('Casas Bahia', $res[1]['parceiro']);
        $this->assertEquals(2021, $res[1]['ano']);
        $this->assertEquals(1, $res[1]['mes']);
        
        $this->assertEquals('Bandeirante', $res[2]['parceiro']);
        $this->assertEquals(97.25, $res[2]['valor']);
        $this->assertEquals(2021, $res[2]['ano']);
        $this->assertEquals(1, $res[2]['mes']);
    }

    function testContaDeveInformarTotalDeContasAPagarEAReceber() {
        // cenário
        $this->CI->load->library('builder/ContaDataBuilder', null, 'builder');
        $this->CI->builder->clear();
        $this->CI->builder->start();

        // ação
        $this->CI->load->library('conta');
        $res = $this->CI->conta->total('pagar', 1, 2021);

        // verificação
        $this->assertEquals(5097.25, $res);
    }

    function testContaDeveCalcularSaldoMensal() {
        // cenário
        $this->CI->load->library('builder/ContaDataBuilder', null, 'builder');
        $this->CI->builder->clear();
        $this->CI->builder->start();

        // ação
        $this->CI->load->library('conta');
        $res = $this->CI->conta->saldo(1, 2021);

        // verificação
        $this->assertEquals(-875.07, $res);
    }

}

// https://phpunit.readthedocs.io/pt_BR/latest/installation.html