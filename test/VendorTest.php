<?php

use Citypantry\Models\Entities\Vendor;

/**
 * Class VendorTest
 */
class VendorTest extends PHPUnit_Framework_TestCase {
    /**
     * @var
     */
    private $vendor;

    /**
     *
     */
    public function testFillFromDatabase() {
        $test = array(
            'id_vendor' => '5',
            'name_vendor' => 'burger truck',
            'postcode' => 'NW85695',
            'max_cover' => '20'
        );

        $this->vendor = Vendor::fillFromDatabase($test);

        $this->assertInstanceOf('Citypantry\Models\Entities\Vendor', $this->vendor);
        $this->assertEquals($this->vendor->getId(), $test['id_vendor']);
        $this->assertEquals($this->vendor->getNameVendor(), $test['name_vendor']);
        $this->assertEquals($this->vendor->getPostCode(), $test['postcode']);
        $this->assertEquals($this->vendor->getMaxCover(), $test['max_cover']);
    }
}
