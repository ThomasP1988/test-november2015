<?php

use Citypantry\Libraries\DataChecker;

/**
 * Class DataCheckerTest
 */
class DataCheckerTest extends PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function advance() {
        $this->assertEquals('11', DataChecker::advance('11h'));
    }

}