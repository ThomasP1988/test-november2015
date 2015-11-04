<?php

use Citypantry\Models\Entities\Package;

/**
 * Class PackageTest
 */
class PackageTest extends PHPUnit_Framework_TestCase {

    /**
     * @var
     */
    private $package;

    /**
     *
     */
    public function testFillFromDatabase() {
        $test = array(
            'id' => '12',
            'id_vendor' => '5',
            'name_package' => 'hamburger',
            'allergies' => 'gluten',
            'advance' => '12'
        );

        $this->package = Package::fillFromDatabase($test);

        $this->assertInstanceOf('Citypantry\Models\Entities\Package', $this->package);
        $this->assertEquals($this->package->getId(), $test['id']);
        $this->assertEquals($this->package->getVendor(), $test['id_vendor']);
        $this->assertEquals($this->package->getNamePackage(), $test['name_package']);
        $this->assertEquals($this->package->getAllergies(), $test['allergies']);
        $this->assertEquals($this->package->getAdvance(), $test['advance']);
    }
}
