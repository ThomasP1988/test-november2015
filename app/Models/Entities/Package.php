<?php
namespace Citypantry\Models\Entities;

class Package {
    private $id;
    private $vendor;
    private $namePackage;
    private $allergies;
    private $advance;

    function __construct($id, $vendor, $namePackage, $allergies, $advance)
    {
        $this->id = $id;
        $this->vendor = $vendor;
        $this->namePackage = $namePackage;
        $this->allergies = $allergies;
        $this->advance = $advance;
    }

    public static function fillFromDatabase(array $row) {
        return new self($row['id'], $row['id_vendor'], $row['name_package'], $row['allergies'], $row['advance']);
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
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param mixed $vendor
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @return mixed
     */
    public function getNamePackage()
    {
        return $this->namePackage;
    }

    /**
     * @param mixed $namePackage
     */
    public function setNamePackage($namePackage)
    {
        $this->namePackage = $namePackage;
    }

    /**
     * @return mixed
     */
    public function getAllergies()
    {
        return $this->allergies;
    }

    /**
     * @param mixed $allergies
     */
    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;
    }

    /**
     * @return mixed
     */
    public function getAdvance()
    {
        return $this->advance;
    }

    /**
     * @param mixed $advance
     */
    public function setAdvance($advance)
    {
        $this->advance = $advance;
    }

}