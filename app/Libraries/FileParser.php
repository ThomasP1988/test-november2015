<?php

namespace Citypantry\Libraries;

use Citypantry\Models\Database;
use Citypantry\Libraries\DataChecker;

/**
 * Class FileParser
 * @package Citypantry\Libraries
 */
class FileParser {

    /**
     *
     */
    const VENDOR_SEPARATOR = PHP_EOLx2;

    /**
     *
     */
    const PACKAGE_SEPARATOR = PHP_EOL;

    /**
     *
     */
    const INFO_SEPARATOR = ';';

    /**
     * @var string
     */
    private $fileContent;

    /**
     * @var Database
     */
    private $database;

    /**
     * @var array
     */
    private $vendors;


    /**
     * @param $file
     */
    public function __construct($file) {
        $this->database = Database::getInstance();
        $this->fileContent = file_get_contents($file);
        $this->vendors = explode(self::VENDOR_SEPARATOR, $this->fileContent);
    }

    /**
     *
     */
    public function parse() {
        foreach($this->vendors as $vendor) {
            $vendorRows = explode(self::PACKAGE_SEPARATOR, $vendor);
            $vendorInfos = explode(self::INFO_SEPARATOR, $vendorRows[0]);
            $vendorId = $this->database->addVendor($vendorInfos[0], $vendorInfos[1], $vendorInfos[2]);

            for($i = 1; $i < count($vendorRows); $i++) {
                $packageInfos = explode(self::INFO_SEPARATOR, $vendorRows[$i]);
                $this->database->addPackage($vendorId, $packageInfos[0], $packageInfos[1], DataChecker::advance($packageInfos[2]));
            }
        }
    }

    /**
     * @return Database
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @return string
     */
    public function getFileContent()
    {
        return $this->fileContent;
    }

    /**
     * @return array
     */
    public function getVendors()
    {
        return $this->vendors;
    }
}