<?php
namespace Citypantry\Views;

use Citypantry\Models\Entities\Package;

/**
 * Class Result
 * @package Citypantry\Views
 */
class Result {

    /**
     * @param $vendors
     */
    public function displaySearchResults($vendors){
        foreach($vendors as $vendor) {
            echo "--------------------------------------------------------" . PHP_EOL;
            echo "Vendor : " . $vendor->getNameVendor() . " , ";
            echo $vendor->getPostCode() . PHP_EOL;

            foreach($vendor->getPackages() as $package) {
                echo $package->getNamePackage()  . " | ";
                echo $package->getAllergies()  . " | ";
                echo $package->getAdvance() . PHP_EOL;
            }
            echo "--------------------------------------------------------";
            echo PHP_EOLx2;
        }
    }
}