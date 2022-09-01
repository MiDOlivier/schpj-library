<?php 
// https://imasters.com.br/back-end/desenvolvendo-web-crawler-e-bots-com-selenium-web-driver-em-php
// https://github.com/kenjis/ci-phpunit-test/tree/2.x

use Facebook\Webdriver\Remote\DesiredCapabilities;
use Facebook\Webdriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use PHPUnit\Framework\TestCase;

class PaginaInicialTest extends TestCase {

    public function testPaginaInicialCarregaCorretamente() {
        $host    = 'http://localhost:4444/wd/hub';
        $browser = DesiredCapabilities::chrome();
        $options = new ChromeOptions();
        
        // $driver = RemoteWebDriver::create($host, $browser);

        $this->assertInstanceOf(ChromeOptions::class, $options);
    }

}