<?php
namespace Citypantry\Models\Entities;

use Citypantry\Models\Entities\Package;

class Vendor {

    private $id;
    private $nameVendor;
    private $postCode;
    private $maxCover;
    private $packages;

    function __construct($id, $nameVendor, $postCode, $maxCover)
    {
        $this->id = $id;
        $this->nameVendor = $nameVendor;
        $this->postCode = $postCode;
        $this->maxCover = $maxCover;
        $this->packages = array();
    }

    public static function fillFromDatabase(array $row) {
        return new self($row['id_vendor'], $row['name_vendor'], $row['postcode'], $row['max_cover']);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNameVendor()
    {
        return $this->nameVendor;
    }

    /**
     * @param mixed $nameVendor
     */
    public function setNameVendor($nameVendor)
    {
        $this->nameVendor = $nameVendor;
    }

    /**
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @param mixed $postCode
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
    }

    /**
     * @return mixed
     */
    public function getMaxCover()
    {
        return $this->maxCover;
    }

    /**
     * @param mixed $maxCover
     */
    public function setMaxCover($maxCover)
    {
        $this->maxCover = $maxCover;
    }

    public function addPackage(Package $package) {
        $this->packages[] = $package;
    }

    /**
     * @return array
     */
    public function getPackages()
    {
        return $this->packages;
    }


}